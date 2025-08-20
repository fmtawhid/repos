<?php

namespace App\Http\Controllers\Install;

use ZipArchive;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    # init update
    public function init()
    {
        if(auth()->user()){

            if (!isAdmin()) {
                abort(403);
            }
        }
       
        return view('update.init');
    }

    # update complete
    public function complete()
    {
        if(auth()->user()) {

            if (!isAdmin() ) {
                abort(403);
            }
        }
        # add new data as required
        $this->__dbMigration();


        # latest version
        writeToEnvFile('APP_VERSION', '1.1.0');
        SystemSetting::updateOrCreate(
            [
                'entity' => 'software_version'
            ],
            [
                'value' => "1.1.0", 
                'user_id'=>1
            ]
        );

        SystemSetting::updateOrCreate(
            [
                'entity' => 'last_update'
            ],
            [
                'value' => Carbon::now(),
                'user_id' => 1,
            ]
        );
        cacheClear();
        $oldRouteServiceProvider        = base_path('app/Providers/RouteServiceProvider.php');
        $setupRouteServiceProvider      = base_path('app/Providers/SetupServiceProvider.php');
        copy($setupRouteServiceProvider, $oldRouteServiceProvider);
        return view('update.complete');
    }

    # db migration
    private function __dbMigration()
    {
        try {
            # artisan cmd
            Artisan::call('migrate');
        } catch (\Throwable $th) {
            //throw $th;
        }

        try {
        
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
    #about system update
    public function about()
    {

    }

    public function versionUpdateInstall(Request $request)
    {
        if (!isAdmin()) {
            abort(403);
        }
        if (env('DEMO_MODE') == "On") {
            flash('Restricted in demo mode')->warning();
            return back();
        }
        ini_set('memory_limit', '-1');

        if ($this->exitLicense($request) == false) {
            flash("Please activate your application with purchase code")->warning();
            return redirect()->route('admin.about-update');
        }
        $isWriteableFiles = $this->getChangedFileList();
        
        if(is_array($isWriteableFiles)) {
            if (count($isWriteableFiles) > 0) {
                flash("Your server does not have file permission to update. please give permission this files")->warning();
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
                        flash('Config File Missing')->error();
                        return redirect()->back();
                    }
                } else {
                    flash('Config File Missing')->error();
                    return redirect()->back();
                }
                $software_version = systemSetting('software_version');

                $current_version = Storage::exists('.version') && Storage::get('.version') ? rtrim(Storage::get('.version'), '\n') : $software_version;

                if ($current_version < $json['min']) {
                    flash($json['min'] . ' or greater is  required for this version')->error();
                    return redirect()->back();
                }

                $src = storage_path('app/public/temp_update');
                $dst = base_path('/');
                // take backup file
                $this->backupFiles($json['version']);
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

            flash("Your system successfully updated")->success();
            return redirect()->back();
        } catch (\Exception $e) {
            Log::info("manual version update issues :" . $e->getMessage());
            // restore if version update interrupt
            $this->interruptBackupFileRestore($updatedFileList);
            if (storage_path('app/public/temp_update')) {
                $this->deleteDirectory(storage_path('app/public/temp_update'));
            }
            if (storage_path('app/tempUpdate')) {
                $this->deleteDirectory(storage_path('app/public/temp_update'));
            }

            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    public function recurse_copy($src, $dst)
    {
        if (!isAdmin()) {
            abort(403);
        }
        try {
            $dir = opendir($src);
            @mkdir($dst);
            while (false !== ($file = readdir($dir))) {
                if (($file != '.') && ($file != '..')) {
                    if (is_dir($src . '/' . $file)) {
                        $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                    } else {
                        $updatedFileList[] = $src . '/' . $file;
                        copy($src . '/' . $file, $dst . '/' . $file);
                    }
                }
            }
            closedir($dir);
        } catch (\Exception $e) {
            Log::info("manual version copy file  issues :" . $e->getMessage());
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    private function exitLicense($request)
    {
      
    }
}
