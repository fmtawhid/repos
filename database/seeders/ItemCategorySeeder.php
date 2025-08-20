<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('item_categories')->delete(); 
        DB::table('item_categories')->insert(array(
            array(
                'id'            => 1,
                'name'          => 'Biriyani',
                'vendor_id'     => '1',
                'is_active'     => '1',
                'created_by_id' => '1',
                'updated_by_id' => NULL,
                'created_at'    => '2025-05-27 06:43:10',
                'updated_at'    => '2025-05-27 06:43:10',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => 2,
                'name'          => 'Burger',
                'vendor_id'     => '1',
                'is_active'     => '1',
                'created_by_id' => '1',
                'updated_by_id' => NULL,
                'created_at'    => '2025-05-28 05:29:51',
                'updated_at'    => '2025-05-28 05:29:51',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => 3,
                'name'          => 'Sandwich',
                'vendor_id'     => '1',
                'is_active'     => '1',
                'created_by_id' => '1',
                'updated_by_id' => NULL,
                'created_at'    => '2025-05-28 05:29:58',
                'updated_at'    => '2025-05-28 05:29:58',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => 4,
                'name'          => 'Biriyani',
                'vendor_id'     => 2,
                'is_active'     => '1',
                'created_by_id' => 2,
                'updated_by_id' => NULL,
                'created_at'    => '2025-05-27 06:43:10',
                'updated_at'    => '2025-05-27 06:43:10',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => 5,
                'name'          => 'Burger',
                'vendor_id'     => 2,
                'is_active'     => '1',
                'created_by_id' => 2,
                'updated_by_id' => NULL,
                'created_at'    => '2025-05-28 05:29:51',
                'updated_at'    => '2025-05-28 05:29:51',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => 6,
                'name'          => 'Sandwich',
                'vendor_id'     => 2,
                'is_active'     => '1',
                'created_by_id' => 2,
                'updated_by_id' => NULL,
                'created_at'    => '2025-05-28 05:29:58',
                'updated_at'    => '2025-05-28 05:29:58',
                'deleted_at'    => NULL
            ),
        ));
    }
}
