<?php

namespace Database\Seeders;

use App\Models\ThemeTagModule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultModules = ['WordpressBlog'];
        foreach($defaultModules as $module){
            ThemeTagModule::updateOrCreate([
                'name' => $module
            ], [
                'is_default' => 1,
                'is_active' => 1
            ]);
        }
    }
}
