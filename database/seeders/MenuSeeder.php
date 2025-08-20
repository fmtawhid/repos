<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branch_menus')->delete(); 
        DB::table('menus')->delete(); 

        DB::table('menus')->insert(array(
            array(
                'id'            => 1,
                'name'          => 'Breakfast',
                'is_active'     => '1',
                'created_by_id' => 1,
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-28 05:45:16',
                'updated_at'    => '2025-05-28 05:45:16',
                'deleted_at'    => NULL,
                'vendor_id'     => 1
            ),
            array(
                'id'            => 2,
                'name'          => 'Lunch',
                'is_active'     => '1',
                'created_by_id' => 1,
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-28 05:46:06',
                'updated_at'    => '2025-05-28 05:46:06',
                'deleted_at'    => NULL,
                'vendor_id'     => 1
            ),
            array(
                'id'            => 3,
                'name'          => 'Dinner',
                'is_active'     => '1',
                'created_by_id' => 1,
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-28 05:46:45',
                'updated_at'    => '2025-05-28 05:46:45',
                'deleted_at'    => NULL,
                'vendor_id'     => 1
            ),
            
            array(
                'id'            => 4,
                'name'          => 'Breakfast',
                'is_active'     => '1',
                'created_by_id' => 2,
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-28 05:45:16',
                'updated_at'    => '2025-05-28 05:45:16',
                'deleted_at'    => NULL,
                'vendor_id'     => 2
            ),
            array(
                'id'            => 5,
                'name'          => 'Lunch',
                'is_active'     => '1',
                'created_by_id' => 2,
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-28 05:46:06',
                'updated_at'    => '2025-05-28 05:46:06',
                'deleted_at'    => NULL,
                'vendor_id'     => 2
            ),
            array(
                'id'            => 6,
                'name'          => 'Dinner',
                'is_active'     => '1',
                'created_by_id' => 2,
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-28 05:46:45',
                'updated_at'    => '2025-05-28 05:46:45',
                'deleted_at'    => NULL,
                'vendor_id'     => 2
            ),
        ));
        
        
        DB::table('branch_menus')->insert(array( 
            array('id' => 1,'branch_id' => '1','menu_id' => '1','is_active' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => 2,'branch_id' => '2','menu_id' => '1','is_active' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => 3,'branch_id' => '1','menu_id' => '2','is_active' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => 4,'branch_id' => '2','menu_id' => '2','is_active' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => 5,'branch_id' => '1','menu_id' => '3','is_active' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => 6,'branch_id' => '2','menu_id' => '3','is_active' => '1','created_at' => NULL,'updated_at' => NULL),

            array('id' => 7,'branch_id' => '3','menu_id' => '4','is_active' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => 8,'branch_id' => '4','menu_id' => '4','is_active' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => 9,'branch_id' => '3','menu_id' => '5','is_active' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => 10,'branch_id' => '4','menu_id' => '5','is_active' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => 11,'branch_id' => '3','menu_id' => '6','is_active' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => 12,'branch_id' => '4','menu_id' => '6','is_active' => '1','created_at' => NULL,'updated_at' => NULL),
        ));
    }
}
