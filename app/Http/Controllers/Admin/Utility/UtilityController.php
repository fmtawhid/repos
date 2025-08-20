<?php

namespace App\Http\Controllers\Admin\Utility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class UtilityController extends Controller
{
    public function index()
    {
        if (!isAdmin()) {
            abort(403);
        }

        return view('backend.admin.settings.utilities');
    }
    #clear cache
    public function clearCache()
    {
        if (!isAdmin()) {
            abort(403);
        }
        cacheClear();
        Artisan::call('optimize:clear');
        return redirect()->back();
    }
    #clear log
    public function clearLog()
    {
        if (!isAdmin()) {
            abort(403);
        }
        file_put_contents(storage_path('logs/laravel.log'), '');
        $message = localize("Your System Log File Is Cleared");
        return redirect()->back();
    }
    #enable/disable app debug
    public function debug()
    {
        if (!isAdmin()) {
            abort(403);
        }

        if (env('APP_DEBUG')) {
            $message = 'Debug Mode Disable Successfully';
            self::writeToEnvFile([
                'DEBUGBAR_ENABLED' => 'false',
                'APP_DEBUG'     => 'false',
            ]);
        } else {
            $message = 'Debug Mode Enable Successfully';
            self::writeToEnvFile([
                'APP_DEBUG'     => 'true',
            ]);
        }
        return redirect()->back();
    }
    # overwrite env file
    private static function writeToEnvFile($data)
    {

        foreach ($data as $key => $value) {
            if (env($key) === $value) {
                unset($data[$key]);
            }
        }

        if (!count($data)) {
            return false;
        }

        $env = file_get_contents(base_path() . '/.env');
        $env = explode("\n", $env);
        foreach ((array) $data as $key => $value) {
            foreach ($env as $env_key => $env_value) {
                $entry = explode("=", $env_value, 2);
                if ($entry[0] === $key) {
                    $env[$env_key] = $key . "=" . (is_string($value) ? '"' . $value . '"' : $value);
                } else {
                    $env[$env_key] = $env_value;
                }
            }
        }
        $env = implode("\n", $env);
        file_put_contents(base_path() . '/.env', $env);
    }
}
