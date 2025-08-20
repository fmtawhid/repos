<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carts')->delete();
        DB::table('order_payments')->delete();
        DB::table('order_products')->delete();
        DB::table('orders')->delete();
        DB::table('product_attributes')->delete();
        DB::table('products')->delete();
        DB::table('branch_menus')->delete();
        DB::table('menus')->delete();
        DB::table('kitchens')->delete();
        DB::table('vendor_customers')->delete();

        DB::table('branches')->delete();
        DB::table('branches')->insert(array(
            array(
                'id'            => '1',
                'is_active'     => '1',
                'vendor_id'     => '1',
                'name'          => 'Branch One',
                'branch_code'   => 'tb',
                'mobile_no'     => '0101012647',
                'email'         => 'branch1@gmail.com',
                'address'       => 'Branch Address 1',
                'latitude'      => NULL,
                'longitude'     => NULL,
                'map_link'      => NULL,
                'open_time'     => NULL,
                'close_time'    => NULL,
                'business_days' => NULL,
                'created_by_id' => NULL,
                'updated_by_id' => '1',
                'deleted_by_id' => NULL,
                'created_at'    => NULL,
                'updated_at'    => '2025-05-27 11:21:51',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => '2',
                'is_active'     => '1',
                'vendor_id'     => '1',
                'name'          => 'Branch Two',
                'branch_code'   => 'tb02',
                'mobile_no'     => '0101012648',
                'email'         => 'branch2@gmail.com',
                'address'       => 'Branch Address 2',
                'latitude'      => NULL,
                'longitude'     => NULL,
                'map_link'      => NULL,
                'open_time'     => NULL,
                'close_time'    => NULL,
                'business_days' => NULL,
                'created_by_id' => '1',
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-27 11:21:18',
                'updated_at'    => '2025-05-27 11:21:18',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => '3',
                'is_active'     => '1',
                'vendor_id'     => '2',
                'name'          => 'Vendor Branch One',
                'branch_code'   => 'vtb01',
                'mobile_no'     => '0101012649',
                'email'         => 'branchv1@gmail.com',
                'address'       => 'Vendor Branch Address 1',
                'latitude'      => NULL,
                'longitude'     => NULL,
                'map_link'      => NULL,
                'open_time'     => NULL,
                'close_time'    => NULL,
                'business_days' => NULL,
                'created_by_id' => '2',
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-27 11:21:18',
                'updated_at'    => '2025-05-27 11:21:18',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => '4',
                'is_active'     => '1',
                'vendor_id'     => '2',
                'name'          => 'Vendor Branch Two',
                'branch_code'   => 'vtb02',
                'mobile_no'     => '0101012650',
                'email'         => 'branchv2@gmail.com',
                'address'       => 'Vendor Branch Address 2',
                'latitude'      => NULL,
                'longitude'     => NULL,
                'map_link'      => NULL,
                'open_time'     => NULL,
                'close_time'    => NULL,
                'business_days' => NULL,
                'created_by_id' => '2',
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-27 11:21:18',
                'updated_at'    => '2025-05-27 11:21:18',
                'deleted_at'    => NULL
            ),
        ));
    }
}
