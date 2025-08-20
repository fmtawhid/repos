<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tables')->delete();
        DB::table('area_branch')->delete();

        DB::table('areas')->delete();

        DB::table('areas')->insert(array(
            array(
                'id'               => 1,
                'name'             => 'Roof Top',
                'vendor_id'        => '2',
                'number_of_tables' => '6',
                'is_active'        => '1',
                'created_by_id'    => '1',
                'updated_by_id'    => '1',
                'created_at'       => '2025-05-27 06:47:59',
                'updated_at'       => '2025-05-27 12:35:02',
                'deleted_at'       => NULL
            ),
            array(
                'id'               => 2,
                'name'             => 'Garden Corner',
                'vendor_id'        => '1',
                'number_of_tables' => '4',
                'is_active'        => '1',
                'created_by_id'    => '1',
                'updated_by_id'    => NULL,
                'created_at'       => '2025-05-27 12:35:21',
                'updated_at'       => '2025-05-27 12:35:21',
                'deleted_at'       => NULL
            ),
            array(
                'id'               => 3,
                'name'             => 'Photogenic Corner',
                'vendor_id'        => '2',
                'number_of_tables' => '4',
                'is_active'        => '1',
                'created_by_id'    => '1',
                'updated_by_id'    => NULL,
                'created_at'       => '2025-05-27 12:35:21',
                'updated_at'       => '2025-05-27 12:35:21',
                'deleted_at'       => NULL
            ),
            array(
                'id'               => 4,
                'name'             => 'Family Dining',
                'vendor_id'        => '2',
                'number_of_tables' => '4',
                'is_active'        => '1',
                'created_by_id'    => '1',
                'updated_by_id'    => NULL,
                'created_at'       => '2025-05-27 12:35:21',
                'updated_at'       => '2025-05-27 12:35:21',
                'deleted_at'       => NULL
            ),
        ));
        
        DB::table('area_branch')->insert(array(
            array(
                'id'        => 1,
                'area_id'   => 1,
                'branch_id' => 1,
                'is_active' => 1,
            ),
            array(
                'id'        => 2,
                'area_id'   => 2,
                'branch_id' => 2,
                'is_active' => 1,
            ),
            array(
                'id'        => 3,
                'area_id'   => 3,
                'branch_id' => 3,
                'is_active' => 1,
            ),
            array(
                'id'        => 4,
                'area_id'   => 4,
                'branch_id' => 4,
                'is_active' => 1,
            ),
        ));
    }
}
