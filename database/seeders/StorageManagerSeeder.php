<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use App\Models\StorageManager;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StorageManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['local', 'aws'];

        foreach($types as $type)
        {
            DB::table('storage_managers')->insert([
                'type'      => $type,
                'is_active' => $type == 'local' ? true: false,
                'user_id'   => 1,
            ]);
        }
        
    }
}
