<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('currencies')->delete();
        
        DB::table('currencies')->insert(array (
            0 => 
            array (
                'id' => '1',
                'code' => appStatic()::DEFAULT_CURRENCY_CODE,
                'name' => 'US Dollar',
                'symbol' => '$',
                'alignment' => '0',
                'rate' => 1,
                'is_active' => 1,
                'user_id' => 1,
                'created_by_id' => 1,
                'created_at' => '2022-11-27 12:21:37',
                'updated_at' => '2022-11-27 12:21:37',
                'deleted_at' => NULL
            ),
        )); 
    }
}
