<?php

namespace App\Http\Controllers\Install;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class InstallController extends Controller
{
    # init installation
    public function init()
    {
        $this->writeToEnvFile('APP_URL', URL::to('/'));
        return view('setup.init');
    }

    # checklist
    public function checklist()
    {
        $permission['curl_enabled']           = function_exists('curl_version');
        $permission['file_get_contents']      = function_exists('file_get_contents');
        $permission['file_put_contents']      = function_exists('file_put_contents');
        $permission['db_file_write_perm']     = is_writable(base_path('.env'));
        $permission['routes_file_write_perm'] = is_writable(base_path('app/Providers/RouteServiceProvider.php'));
        $permission['server_connection']      = true;
        return view('setup.checklist', compact('permission'));
    }

    # db form
    public function databaseSetup($error = "")
    {
        if ($error == "") {
            return view('setup.dbSetup');
        } else {
            return view('setup.dbSetup', compact('error'));
        }
    }

    # db store
    public function storeDatabaseSetup(Request $request)
    {
        if ($this->checkDatabaseConnection($request->DB_HOST . ':' . $request->DB_PORT, $request->DB_DATABASE, $request->DB_USERNAME, $request->DB_PASSWORD)) {
            $path = base_path('.env');
            if (file_exists($path)) {
                foreach ($request->types as $type) {
                    $this->writeToEnvFile($type, $request[$type]);
                }
                return redirect('db-migration');
            } else {
                // fallback
                return redirect('database-setup');
            }
        } else {
            // db connection error
            return redirect('database-setup/database_error');
        }
    }

    # overwrite env file
    public function writeToEnvFile($type, $val)
    {
        writeToEnvFile($type, $val);
    }

    # check db connection
    function checkDatabaseConnection($db_host = "", $db_name = "", $db_user = "", $db_pass = "")
    {
        if (@mysqli_connect($db_host, $db_user, $db_pass, $db_name)) {
            return true;
        } else {
            return false;
        }
    }

    # db migration confirmation view
    public function dbMigration()
    {

        if ($this->checkDatabaseConnection(env('DB_HOST').":".env('DB_PORT'), env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'))) {
            return view('setup.dbMigration');
        } else {
            // db connection error
            return redirect('database-setup/database_error');
        }
    }

    # run db migration
    public function runDbMigration($demo = false)
    {
        if ($demo) {
            $this->runDemoDbMigration();
        } else {
            # run migrations  here
            Artisan::call('migrate:fresh');

            # run seeds here
            Artisan::call('db:seed');
        }

        cacheClear();
        return redirect()->route('installation.storeAdminForm');
    }

    # run Demo db migration
    public function runDemoDbMigration($name = 'demo')
    {
        // TODO:: [update version] demo seeders
        ini_set('memory_limit', '-1');
        $this->writeToEnvFile('DEMO_MODE', 'On');
        $sql_path = base_path($name . '.sql');
        DB::unprepared(file_get_contents($sql_path));
    }

    # add admin form view
    public function storeAdminForm()
    {

        if ($this->checkDatabaseConnection(env('DB_HOST').":".env('DB_PORT'), env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'))) {
            return view('setup.adminConfig');
        } else {
            // db connection error
            return redirect('database-setup/database_error');
        }
    }

    # admin configuration
    public function storeAdmin(Request $request)
    {

        $user = User::where('user_type', appStatic()::TYPE_ADMIN)->first();
        $user->first_name      = $request->admin_name;
        $user->email     = $request->admin_email;
        $user->password  = Hash::make($request->admin_password);
        $user->email_verified_at = date('Y-m-d H:m:s');
        $user->save();

        $oldRouteServiceProvider        = base_path('app/Providers/RouteServiceProvider.php');
        $setupRouteServiceProvider      = base_path('app/Providers/SetupServiceProvider.php');
        copy($setupRouteServiceProvider, $oldRouteServiceProvider);
        return view('setup.complete');
    }
}

