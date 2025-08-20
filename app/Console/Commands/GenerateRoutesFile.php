<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class GenerateRoutesFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    /**
     * The console command description.
     *
     * @var string
     */
    protected $signature = 'generate:routes-file';
    protected $description = 'Generate a PHP file with an associative array of routes';

    public function handle()
    {
        $routes = Route::getRoutes();
        $formattedRoutes = [];

        foreach ($routes as $route) {
            $actionName = $route->getActionName();
            if (strpos($actionName, 'App\Http\Controllers') === false) {
                continue;
            }

            $name = $route->getName();
            if (!$name) {
                continue;
            }

            $segments = explode('.', $name);
            if (count($segments) < 3 || $segments[0] !== 'admin') {
                continue;
            }

            $resource = $segments[1];
            $action = $segments[2];

            $prefix = '';
            switch ($action) {
                case 'index':
                    $prefix = 'all_';
                    break;
                case 'create':
                    $prefix = 'add_';
                    break;
                case 'store':
                    $prefix = 'store_';
                    break;
                case 'show':
                    $prefix = 'show_';
                    break;
                case 'edit':
                    $prefix = 'edit_';
                    break;
                case 'destroy':
                    $prefix = 'delete_';
                    break;
                default:
                    continue 2;
            }

            $key = $prefix . $resource;
            $formattedRoutes[$resource][$key] = $name;
        }

        $this->writeToFile($formattedRoutes);
    }

    protected function writeToFile(array $routes)
    {
        $filePath = base_path('myRoutes.php');
        $content = '<?php return ' . var_export($routes, true) . ';';
        file_put_contents($filePath, $content);
        $this->info('Routes file generated successfully.');
    }
}
