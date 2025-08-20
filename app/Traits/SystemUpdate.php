<?php

namespace App\Traits;

use App\Models\License;
use App\Utils\AppStatic;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use App\Http\Services\SystemUpdateService;

trait SystemUpdate
{
    public function latestVersion($versionNumber = false)
    {
        try {
            $serverRes = $this->versionList();
            if ($serverRes['status'] == false) {
                return false;
            }

            $allVersions = [];
            $response = (array)$serverRes['data'];
            if (!empty($response)) {
                foreach ($response as $key => $version) {
                    $allVersions[] = $key;
                }
            }

            $array_key_last = array_key_last($allVersions);
            $latestVersion  = !empty($allVersions[$array_key_last]) ? $allVersions[$array_key_last] : 0;
            if ($versionNumber) {
                return $latestVersion;
            }

            $currentVersion   = currentVersion();
            if (isGreater($currentVersion, $latestVersion)) {
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            Log::info("Latest version issues :" . $th->getMessage());
        }
    }
    public function  versionList()
    {
        try {
            $license = License::first();
            $opts = [
                'purchase_code'        => $license ? $license->purchase_code: '',
                'app_name'             => env('APP_NAME'),
                'current_version'      => currentVersion(),
                'customer_current_url' => URL::to('/'),
                'client_token'         => $license ? $license->client_token : '',
                'product_type'         => 1,
                'server_info'          => $_SERVER,
                'app_env'              => $license->app_env
            ];
            $systemUpdate = new SystemUpdateService;
            $response     = $systemUpdate->versionLists($opts);
            $response     = json_decode($response);
           

            return json_last_error() === JSON_ERROR_NONE ? $response : ["status" => false, "data" => [], "error" => "Page not found"];
        } catch (\Throwable $th) {
            Log::info("Failed ! version list response log issues :" . json_encode(errorArray($th)));

            return ["status" => false, "data" => [], "error" => $th->getMessage()];
        }
    }
    public function  versionUpdate()
    {
        try {
            $license = License::first();
            $opts = [
                'purchase_code'        => $license ? $license->purchase_code: '',
                'app_name'             => env('APP_NAME'),
                'current_version'      => currentVersion(),
                'server_info'          => $_SERVER,
                'customer_current_url' => URL::to('/'),
                'client_token'         => $license ? $license->client_token : '',
                'product_type'         => 1,
                'app_env'              => $license->app_env
            ];
            $systemUpdate = new SystemUpdateService;
            $response     = $systemUpdate->updates($opts);
            $response     = json_decode($response);
            return json_last_error() === JSON_ERROR_NONE ? (array)$response->data->version_lists : ["status" => false, "data" => [], "error" => "Page not found"];
        } catch (\Throwable $th) {
            Log::info("Failed ! version Update with Zip:" . json_encode(errorArray($th)));

            return ["status" => false, "data" => [], "error" => $th->getMessage()];
        }
    }

    # get version changes file from request server
    public function  getChangedFileList($version = null, $is_writeable = false, $withBasePath = true)
    {
        try {
            $versionDetails = $this->versionList();
            if($versionDetails){
                $versionDetails = (array)$versionDetails->data->version_lists;
            }
            $data           = $versionDetails ?? [];
            $collection     = collect($data);
          
            $takeMaxFile    = AppStatic::maxUpdateFile;
            $slice          = $collection->slice($takeMaxFile);

            $allFiles       = [];
            if ($slice) {
             
                if ($version) {
                   
                    $versionSlice = $slice[$version]->changed_file_list;
                    foreach ($versionSlice as $item) {

                        $file_path = base_path($item);

                        if ($is_writeable) {
                            if (!is_writable($file_path)) {
                                if(file_exists($file_path)) {
                                    $allFiles[] = $withBasePath ? $file_path : $item;
                                }
                            }
                        } elseif($is_writeable == false) {
                            if(file_exists($file_path)) {
                                $allFiles[] = $withBasePath ? $file_path : $item;
                            }
                        }
                    }
                } else {
                   
                    foreach ($slice as $item) {
                   
                        $changed_file_list = $item->changed_file_list;
                        foreach ($changed_file_list as $file) {
                            $file_path = base_path($file);
                            if($is_writeable){
                                if (!is_writable($file_path)) {
                                    if(file_exists($file)) {
                                        $allFiles[] = $withBasePath ? $file_path : $file;
                                    }
                                }
                            }elseif($is_writeable == false){
                                if(file_exists($file)) {
                                    $allFiles[] = $withBasePath ? $file_path : $file;
                                }
                            }
                            
                        }
                    }
                }
            }
        
            return $allFiles;
        } catch (\Throwable $th) {
            Log::info("Failed ! Get Changed List" . json_encode(errorArray($th)));
        }
    }
    # rename old file 
    public function fileRename($currentVersion, $version = null, $is_writeable = false)
    {

        $files = $this->getChangedFileList($version, $is_writeable);
        foreach ($files as $file) {
            if (file_exists($file)) {
                rename($file, $file . '.' . $currentVersion);
            }
        }
    }
    # remove str from rename file
    public function fileRenameUndo($currentVersion, $version = null, $is_writeable = false, $is_deleteAble = false)
    {
        $files = $this->getChangedFileList($version, $is_writeable);
        foreach ($files as $file) {
            $rename_file = $file . '.' . $currentVersion;
            if (file_exists($rename_file)) {
                if ($is_deleteAble) {
                    unlink($rename_file);
                } else {
                    rename($rename_file, $file);
                }
            }
        }
    }
    # file back up before update
    public function backupFiles($versionStr)
    {
        $versionNo = getNumberFromString($versionStr);
        try {
            $backupPath = base_path('storage' . AppStatic::DS . 'backup' . AppStatic::DS . $versionNo . AppStatic::DS);

            if (!file_exists($backupPath)) {
                mkdir($backupPath, 0777, true);
            }
  
            $files = $this->getChangedFileList($versionStr, $is_writeable = false, false);

            if ($files) {
                foreach ($files as $file) {

                    $fileBackupPath = $backupPath . AppStatic::DS . $file;
                    $updateDirName  = dirname($fileBackupPath);

                    $file = base_path($file);

                    if (!file_exists($updateDirName)) {
                        mkdir($updateDirName, 0777, true);
                    }
                    if (file_exists($file)) {
                        copy($file, $fileBackupPath);
                    }
                }
            }
        } catch (\Throwable $th) {
            Log::info('Failed to take backup : ' . json_encode(errorArray($th)));
        }
    }
    # restore backup
    public function restoreBackupVersionFiles($versionStr)
    {
        try {
            $versionNo = getNumberFromString($versionStr);
            $backupPath = base_path('storage' . AppStatic::DS . 'backup' . AppStatic::DS . $versionNo . AppStatic::DS);
            if (file_exists($backupPath)) {
                $dst = base_path('/');
                $this->recursionCopy($backupPath, $dst);
            }
        } catch (\Throwable $th) {
            Log::info("Failed ! Restore Backup" . json_encode(errorArray($th)));
        }
    }
    # delete backup version
    public function removeBackupVersion()
    {
        try {
            $versionDetails = $this->versionList();
            if($versionDetails){
                $versionDetails = (array)$versionDetails->data->version_lists;
            }
            $data           = $versionDetails ?? [];
            if ($data) {
                $collections                 =  collect($data);
                $allVersions                 =  [];
                foreach ($collections as $key => $item) {
                    $allVersions[]           = $key;
                }
                $takeLatestMaxFile           =  AppStatic::maxUpdateFile;
                $takeLatestMaxVersion        =  array_slice($allVersions, $takeLatestMaxFile);

                foreach ($allVersions as $version) {
                    $versionNo = getNumberFromString($version);
                    $dirname = base_path('storage' . AppStatic::DS . 'backup' . AppStatic::DS . $versionNo . AppStatic::DS);
                    if (!in_array($version, $takeLatestMaxVersion)) {
                        if (file_exists($dirname)) {

                            $this->deleteDirectory($dirname);
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            Log::info("Failed ! Backup Remove" . json_encode(errorArray($th)));
        }
    }
    #
    public function interruptBackupFileRestore($files = [] )
    {
        try{
            $notFound = [];
            if(!empty($files)){
                $dst = base_path('/');
               foreach($files as $file){
                    $temp_update = explode('temp_update/', $file);
                    $temp_update_path = $temp_update[0];  
                    $temp_update_file = $temp_update[1];  
                    $version_array = explode('/', $temp_update_file); 
                    $str_replace = $version_array[0]. '/'; 
                    $restore_file = str_replace($str_replace, '', $temp_update_file);  
                      
                    $dirname = base_path('storage' . AppStatic::DS . 'backup' . AppStatic::DS);
                    if(file_exists($dirname.$temp_update_file)){
                        copy($dirname.$temp_update_file, $dst . $restore_file);
                    }else{
                        $notFound[] = $file;
                    }                    
               }          
            }else{
                Log::info('not found files : ' .json_encode($notFound));
            }
        }
        catch (\Throwable $th) {
            Log::info("Failed ! Interrupt Backup while reverting OLD Files" . json_encode(errorArray($th)));
        }
    }
    # system check connection
    public function systemCheck()
    {
        $connect = $this->versionList();
      
        if (!empty($connect)) {
            return true;
        }
        Log::info("System! Failed to connect with themetags server.");

        return false;
    }
    # system check connection
    public function healthCheckSystem()
    {
        $service = new SystemUpdateService;
        $connect = $service->healthCheck(['data'=>'']);
        if (!empty($connect)) {
            return true;
        }
        Log::info("Health! Failed to connect with themetags server.");
        return false;
    }
    # recursion copy file
    public function recursionCopy($src, $dst)
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
                        $this->recursionCopy($src . '/' . $file, $dst . '/' . $file);
                    } else {
                        copy($src . '/' . $file, $dst . '/' . $file);
                    }
                }
            }
            closedir($dir);
        } catch (\Throwable $e) {
            Log::info("Recursion Error : " . json_encode(errorArray($e)));
            flash('Operation Failed')->error();
            return redirect()->back();
        }
    }
    # delete directory wih file
    public function deleteDirectory($dirname)
    {
        try {
            if (is_dir($dirname)) {
                $dir_handle = opendir($dirname);
            } else {
                return false;
            }

            if (!$dir_handle)
                return false;
            while ($file = readdir($dir_handle)) {
                if ($file != "." && $file != "..") {
                    if (!is_dir($dirname . "/" . $file))
                        unlink($dirname . "/" . $file);
                    else
                        $this->deleteDirectory($dirname . '/' . $file);
                }
            }
            closedir($dir_handle);
            rmdir($dirname);
            return true;
        } catch (\Throwable $e) {
            Log::info("Failed to Delete Directory : " . json_encode(errorArray($e)));
        }
    }
}