<?php

namespace App\Http\Controllers\Admin\Update;

use App\Http\Controllers\Controller;
use App\Services\SystemUpdateService;
use App\Models\License;
use App\Models\SystemSetting;
use App\Services\Action\LicenseActionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZipArchive;


class UpdateController extends Controller
{
    private $systemUpdateService;

    public function __construct()
    {
        $this->systemUpdateService = new SystemUpdateService();
    }

    public function update(Request $request)
    {
        if (!isAdmin()) {
            abort(403);
        }

        $data["is_purchase"] = false; // (new LicenseActionService())->isPurchased();

        return view("backend.admin.update.index")->with($data);
    }


    public function oneClickUpdate(Request $request)
    {
        ini_set('memory_limit', -1);

        try{
            $purchaseCode = $request->purchase_code;
            $serverMode   = $request->server_mode;

            $currentVersion = currentVersion(true);
            $latestVersion  = session()->get('latestVersion') ?? null;

            if($latestVersion){
                if($currentVersion >= getNumberFromString($latestVersion)) {

                    flashMessage("you are using latest version","error");
                    return redirect()->route('admin.systemUpdate.update');
                }
            }


            if(!$this->exitLicense($request)) {

                flashMessage("Please activate your application with purchase code","error");
                return redirect()->route('admin.systemUpdate.update');
            }

            $healthCheckSystem = $this->systemUpdateService->healthCheck(true);

            if ($healthCheckSystem == false) {
                flashMessage("Your server does not have permission to update. Please try manual update","error");

                return redirect()->route('admin.systemUpdate.update');
            }

            $updatedFileList = [];

            $isWriteableFiles = $this->systemUpdateService->getChangedFileList(null, true);

            if(is_array($isWriteableFiles)) {
                if (count($isWriteableFiles) > 0) {
                    flashMessage("Your server does not have file permission to update. please give permission this files","error");
                    return redirect()->route('admin.systemUpdate.file-permission');
                }
            }

            try {
                $name = 'VersionUpdate.zip';
                $versionList = $this->systemUpdateService->versionUpdate();

                if (!empty($versionList)) {
                    foreach ($versionList as $version => $data) {
                        try {
                            $updateFile = $data->link;
                            $basePath   = base_path('/storage/app/public/temp_update/');

                            if (!file_exists($basePath)) {
                                mkdir($basePath, 0777, true);
                            }
                            // download file and put into directory
                            file_put_contents($basePath . $name, fopen($updateFile, 'r'));

                            $zip = new ZipArchive;
                            $res = $zip->open($basePath . $name);

                            $latestFileDirPath = $basePath . getNumberFromString($version) . '/';
                            if ($res === true) {
                                $zip->extractTo($latestFileDirPath);
                                $zip->close();
                            } else {
                                abort(500, 'Error! Could not open File');
                            }

                            //  check json file exits
                            $str = @file_get_contents($latestFileDirPath . 'config.json', true);
                            if ($str === false) {
                                abort(500, 'The update file is corrupt.');
                            }

                            $json = json_decode($str, true);

                            if (!empty($json)) {
                                if (empty($json['version']) || empty($json['release_date'])) {
                                    flashMessage('Config File Missing',"error");
                                    return redirect()->back();
                                }
                            } else {
                                flashMessage('Config File Missing',"error");
                                return redirect()->back();
                            }
                            // file unzip path
                            $src = storage_path('app/public/temp_update') . '/' . getNumberFromString($version);
                            $dst = base_path('/');

                            // take backup file
                            $this->systemUpdateService->backupFiles($version);

                            // file replace for update
                            $this->applyUpdate($src, $dst, $version, $updatedFileList);

                            // take  file from storage path
                            if (storage_path('app/public/temp_update')) {
                                $this->deleteDirectory(storage_path('app/public/temp_update'));
                            }
                            if (storage_path('app/public/temp_update')) {
                                $this->deleteDirectory(storage_path('app/public/temp_update'));
                            }

                            //  file migration
                            $this->dbMigration();

                            // version update in database
                            SystemSetting::updateOrCreate(
                                [
                                    'entity' => 'software_version'
                                ],
                                [
                                    'value' => $version
                                ]
                            );


                            SystemSetting::updateOrCreate(
                                [
                                    'entity' => 'last_update'
                                ],
                                [
                                    'value' => Carbon::now()
                                ]
                            );
                            // take last [maxUpdateFile] ex: 5 version and delete others
                            $this->systemUpdateService->removeBackupVersion($version);

                            // remove cache
                            writeToEnvFile('APP_VERSION', 'v'.$version);

                            cacheClear();
                        } catch (\Throwable $th) {
                            Log::info('Failed ! restore :'. $th->getMessage());
                            // restore if version update interrupt
                            $this->systemUpdateService->interruptBackupFileRestore($updatedFileList);
                        }
                    }
                    flashMessage("Your system successfully updated");
                }
                return redirect()->back();
            } catch (\Exception $e) {
                // restore if version update interrupt
                $this->systemUpdateService->interruptBackupFileRestore($updatedFileList);
                if (storage_path('app/public/temp_update')) {
                    $this->systemUpdateService->deleteDirectory(storage_path('app/public/temp_update'));
                }
                if (storage_path('app/tempUpdate')) {
                    $this->systemUpdateService->deleteDirectory(storage_path('app/public/temp_update'));
                }
                flashMessage($e->getMessage(),"error");
                return redirect()->back();
            }
        }
        catch(\Throwable $e){

            wLog("Failed to update one click", errorArray($e));

            flashMessage($e->getMessage(),"error");

            return redirect()->back()->withErrors(errorArray($e));
        }
    }

    # file copy
    public function applyUpdate($src, $dst, $version, &$updatedFileList)
    {
        $version = getNumberFromString($version);
        $backupPath = base_path('storage' . appStatic()::DS . 'backupFile' . appStatic()::DS . $version . appStatic()::DS);
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0777, true);
        }
        try {
            $dir = opendir($src);
            @mkdir($dst);
            while (false !== ($file = readdir($dir))) {
                if (($file != '.') && ($file != '..')) {
                    if (is_dir($src . '/' . $file)) {
                        $this->applyUpdate($src . '/' . $file, $dst . '/' . $file, $version, $updatedFileList);
                    } else {
                        $updatedFileList[] = $src . '/' . $file;
                        copy($src . '/' . $file, $dst . '/' . $file);
                    }
                }
            }
            closedir($dir);
        } catch (\Exception $e) {
            flash('Operation Failed')->error();
            return redirect()->back();
        }
    }

    private function dbMigration()
    {
        try {
            # artisan cmd
            Artisan::call('migrate', array('--force' => true));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    
    private function exitLicense($request)
    {
        try{
            $status = false;

            $license = (new LicenseActionService())->getMyLicense();

            if(!empty($license)) {
                $opts = [
                    "body" => [
                        'purchase_code'        => $request->purchase_code,
                        'app_name'             => env('APP_NAME'),
                        'current_version'      => env('APP_VERSION'),
                        'customer_current_url' => request()->fullUrl(),
                        'product_type'         => 1,
                        'app_env'              => $request->server_mode,
                        'server_info'          => $_SERVER
                    ]
                ];

                $healthCheck = $this->systemUpdateService->healthCheck(true);


                if ($healthCheck) {
                    $licenseVerification = $this->systemUpdateService->verification($opts);

                    // Failed Communication ?
                    if(!$licenseVerification["status"]){
                        throw new \Exception($licenseVerification["message"], $licenseVerification["code"] ?? 500);
                    }


                    $response = $licenseVerification;


                    if($response){
                       $license = (new LicenseActionService())->updateLicense(
                           $license,
                           $licenseVerification["data"]["purchase_code"],
                           $licenseVerification["data"]["client_token"],
                            $request->server_mode
                        );

                       $status = true;
                    }
                }
            }

            return $status;
        }
        catch(\Exception $e){
            Log::info('license save when update :' . $e->getMessage());

            throw new \Exception($e->getMessage(), \appStatic()::VALIDATION_ERROR);
        }

    }

    public function versionUpdateInstall(Request $request)
    {
        if (!isAdmin()) {
            abort(403);
        }
        if (env('DEMO_MODE') == "On") {
            flashMessage('Restricted in demo mode',"error");
            return back();
        }
        ini_set('memory_limit', '-1');

        if ($this->exitLicense($request) == false) {
            flashMessage("Please activate your application with purchase code","error");
            return redirect()->route('admin.systemUpdate.update');
        }

        $isWriteableFiles = $this->getChangedFileList();

        if(is_array($isWriteableFiles)) {
            if (count($isWriteableFiles) > 0) {
                flashMessage("Your server does not have file permission to update. please give permission this files","error");
                return redirect()->route('system.file-permission');
            }
        }

        $updatedFileList = [];
        try {

            $request->validate([
                'updateFile' => ['required', 'mimes:zip'],
            ]);

            if ($request->hasFile('updateFile')) {
                // $path = $request->updateFile->store('updateFile');
                //Move Uploaded File

                $zip_file = $request->file('updateFile');
                $basePath = base_path('/storage/app/public/temp_update/');
                if (!file_exists($basePath)) {
                    mkdir($basePath, 0777,true);
                }
                $res = $zip_file->move($basePath, $zip_file->getClientOriginalName());

                $zip = new ZipArchive;
                $res = $zip->open($basePath . $zip_file->getClientOriginalName());

                if ($res === true) {
                    $zip->extractTo($basePath);
                    $zip->close();
                } else {
                    abort(500, 'Error! Could not open File');
                }

                $str = @file_get_contents($basePath . '/config.json', true);
                if ($str === false) {
                    abort(500, 'The update file is corrupt.');
                }

                $json = json_decode($str, true);

                if (!empty($json)) {
                    if (empty($json['version']) || empty($json['release_date'])) {
                        flashMessage('Config File Missing',"error");
                        return redirect()->back();
                    }
                } else {
                    flashMessage('Config File Missing',"error");
                    return redirect()->back();
                }
                $software_version = systemSetting('software_version');

                $current_version = Storage::exists('.version') && Storage::get('.version') ? rtrim(Storage::get('.version'), '\n') : $software_version;

                if ($current_version < $json['min']) {
                    flashMessage($json['min'] . ' or greater is  required for this version',"error");
                    return redirect()->back();
                }

                $src = storage_path('app/public/temp_update');
                $dst = base_path('/');
                // take backup file
                $this->systemUpdateService->backupFiles($json['version']);
                //
                $this->recurse_copy($src, $dst);

                if (isset($json['migrations']) & !empty($json['migrations'])) {
                    foreach ($json['migrations'] as $migration) {

                        Artisan::call(
                            'migrate',
                            array(
                                '--path' => $migration,
                                '--force' => true
                            )
                        );
                    }
                }
                SystemSetting::updateOrCreate(
                    [
                        'entity' => 'software_version'
                    ],
                    [
                        'value' => $json['version']
                    ]
                );

                SystemSetting::updateOrCreate(
                    [
                        'entity' => 'last_update'
                    ],
                    [
                        'value' => Carbon::now()
                    ]
                );
                writeToEnvFile('APP_VERSION', 'v' . $json['version']);
            }


            if (storage_path('app/public/temp_update')) {
                $this->deleteDirectory(storage_path('app/public/temp_update'));
            }
            if (storage_path('app/public/temp_update')) {
                $this->deleteDirectory(storage_path('app/public/temp_update'));
            }

            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('config:clear');
            Artisan::call('optimize:clear');

            flashMessage("Your system successfully updated");
            return redirect()->back();
        } catch (\Exception $e) {
            Log::info("manual version update issues :" . $e->getMessage());
            // restore if version update interrupt
            $this->systemUpdateService->interruptBackupFileRestore($updatedFileList);
            if (storage_path('app/public/temp_update')) {
                $this->deleteDirectory(storage_path('app/public/temp_update'));
            }
            if (storage_path('app/tempUpdate')) {
                $this->deleteDirectory(storage_path('app/public/temp_update'));
            }

            flashMessage($e->getMessage(),"error");
            return redirect()->back();
        }
    }
}
