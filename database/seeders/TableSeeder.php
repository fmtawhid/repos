<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tables')->delete();
        DB::table('tables')->insert(array(
            array(
                'id'              => 1,
                'name'            => NULL,
                'table_code'      => 'TB-101',
                'area_id'         => '1',
                'number_of_seats' => '6',
                'is_active'       => '1',
                'created_by_id'   => 2,
                'updated_by_id'   => NULL,
                'created_at'      => '2025-05-27 12:39:59',
                'updated_at'      => '2025-05-27 12:39:59',
                'deleted_at'      => NULL,
                'qr_code_id'      => 1
            ),
            array(
                'id'              => 2,
                'name'            => NULL,
                'table_code'      => 'TB-102',
                'area_id'         => '4',
                'number_of_seats' => '4',
                'is_active'       => '1',
                'created_by_id'   => 2,
                'updated_by_id'   => NULL,
                'created_at'      => '2025-05-27 12:42:08',
                'updated_at'      => '2025-05-27 12:42:08',
                'deleted_at'      => NULL,
                'qr_code_id'      => 2
            ),
            array(
                'id'              => 3,
                'name'            => NULL,
                'table_code'      => 'TB-103',
                'area_id'         => 3,
                'number_of_seats' => '4',
                'is_active'       => '1',
                'created_by_id'   => 2,
                'updated_by_id'   => NULL,
                'created_at'      => '2025-05-27 12:42:08',
                'updated_at'      => '2025-05-27 12:42:08',
                'deleted_at'      => NULL,
                'qr_code_id'      => 3
            ),
            array(
                'id'              => 4,
                'name'            => NULL,
                'table_code'      => 'TB-104',
                'area_id'         => 4,
                'number_of_seats' => '4',
                'is_active'       => '1',
                'created_by_id'   => 2,
                'updated_by_id'   => NULL,
                'created_at'      => '2025-05-27 12:42:08',
                'updated_at'      => '2025-05-27 12:42:08',
                'deleted_at'      => NULL,
                'qr_code_id'      => 4
            ),
        ));
    }
}
