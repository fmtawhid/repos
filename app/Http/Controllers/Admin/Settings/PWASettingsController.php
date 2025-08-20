<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PWASettingRequestForm;

class PWASettingsController extends Controller
{
    public function index()
    {
        return view ('backend.admin.settings.pwa-settings');
    }
    public function store(PWASettingRequestForm $request)
    {

        $path             = '/images/icons/';
        $start_url        = $request->start_url;      
        $public_start_url = $request->start_url;

        if ($request->icon_72) {
            $this->fileUpload($path, $request->file('icon_72'), 'icon-72x72.png', $public_start_url);
          
        }
        if ($request->icon_96) {
            $this->fileUpload($path, $request->file('icon_96'), 'icon-96x96.png', $public_start_url);
           
        }
        if ($request->icon_128) {
           $this->fileUpload($path, $request->file('icon_128'), 'icon-128x128.png', $public_start_url);
          
        }
        if ($request->icon_144) {
           $this->fileUpload($path, $request->file('icon_144'), 'icon-144x144.png', $public_start_url);
           
        }
        if ($request->icon_152) {
           $this->fileUpload($path, $request->file('icon_152'), 'icon-152x152.png', $public_start_url);
           
        }
        if ($request->icon_192) {
           $this->fileUpload($path, $request->file('icon_192'), 'icon-192x192.png', $public_start_url);
           
        }
        if ($request->icon_384) {
            $this->fileUpload($path, $request->file('icon_384'), 'icon-384x384.png', $public_start_url);
           
        }
        if ($request->icon_512) {
           $this->fileUpload($path, $request->file('icon_512'), 'icon-512x512.png', $public_start_url);
            
        }
        if ($request->screenshot_540) {
           $this->fileUpload($path, $request->file('screenshot_540'), '540x720.png', $public_start_url);
            
        }
        if ($request->screenshot_720) {
           $this->fileUpload($path, $request->file('screenshot_720'), '720x540.png', $public_start_url);
            
        }
        if(!empty($request->env)) {
            
            foreach($request->env as $key=>$value) {
               writeToEnvFile($key, $value);
            }
        }

        cacheClear();

        flash(localize('Operation successfully'))->success();
        return redirect()->route('admin.pwa-settings.index');
    }
    public  function fileUpload($path, $file, $name, $start_url = null)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $fileName = $path . $name;
        if (file_exists($fileName)) {
            try {
                unlink($fileName);
            } catch (\Throwable $th) {}
        }

        $file->move($path, $name);
        $fileName = $path . $name;

        return $start_url.'/'.$fileName;
    }
}
