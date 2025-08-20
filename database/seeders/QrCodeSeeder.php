<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class QrCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('qr_codes')->delete(); 
        DB::table('qr_codes')->insert(array(
            array(
                'id'         => 1,
                'title'      => NULL,
                'code'       => 'iMLYZq4edIV6',
                'created_at' => '2025-05-27 06:50:50',
                'updated_at' => '2025-05-27 06:50:50'
            ),
            array(
                'id'         => 2,
                'title'      => NULL,
                'code'       => 'htxDR5EeSw12',
                'created_at' => '2025-05-27 12:39:59',
                'updated_at' => '2025-05-27 12:39:59'
            ),
            array(
                'id'         => 3,
                'title'      => NULL,
                'code'       => 'htxDR6EeSw12',
                'created_at' => '2025-05-27 12:39:59',
                'updated_at' => '2025-05-27 12:39:59'
            ),
            array(
                'id'         => 4,
                'title'      => NULL,
                'code'       => 'htxDA5EeSw12',
                'created_at' => '2025-05-27 12:39:59',
                'updated_at' => '2025-05-27 12:39:59'
            ),
        ));
    }
}
