<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carts')->delete(); 
        DB::table('product_attributes')->delete(); 
        DB::table('products')->delete(); 

        DB::table('products')->insert(array(
            array(
                'id'               => '1',
                'vendor_id'        => '1',
                'is_active'        => '1',
                'name'             => 'Chicken Biriyani',
                'menu_id'          => '1',
                'item_category_id' => '2',
                'media_manager_id' => NULL,
                'preparation_time' => '20',
                'description'      => 'Chicken Biriyani is a delicious sub-continental origined food.',
                'product_addons'   => '[{"title":"Borhani","price":"70"},{"title":"Drinks","price":"40"}]',
                'created_by_id'    => '1',
                'updated_by_id'    => NULL,
                'deleted_by_id'    => NULL,
                'created_at'       => '2025-05-28 06:59:03',
                'updated_at'       => '2025-05-28 06:59:03',
                'deleted_at'       => NULL
            ),
            array(
                'id'               => '2',
                'vendor_id'        => '1',
                'is_active'        => '1',
                'name'             => 'Mutton Biriyani',
                'menu_id'          => '1',
                'item_category_id' => '2',
                'media_manager_id' => NULL,
                'preparation_time' => '20',
                'description'      => NULL,
                'product_addons'   => '[{"title":"Borhani","price":"70"},{"title":"Drinks","price":"40"}]',
                'created_by_id'    => '1',
                'updated_by_id'    => NULL,
                'deleted_by_id'    => NULL,
                'created_at'       => '2025-05-28 07:11:24',
                'updated_at'       => '2025-05-28 07:11:24',
                'deleted_at'       => NULL
            ),

            array(
                'id'               => 3,
                'vendor_id'        => 2,
                'is_active'        => '1',
                'name'             => 'Chicken Biriyani',
                'menu_id'          => 4,
                'item_category_id' => 5,
                'media_manager_id' => NULL,
                'preparation_time' => '20',
                'description'      => 'Chicken Biriyani is a delicious sub-continental origined food.',
                'product_addons'   => '[{"title":"Borhani","price":"70"},{"title":"Drinks","price":"40"}]',
                'created_by_id'    => 2,
                'updated_by_id'    => NULL,
                'deleted_by_id'    => NULL,
                'created_at'       => '2025-05-28 06:59:03',
                'updated_at'       => '2025-05-28 06:59:03',
                'deleted_at'       => NULL
            ),
            array(
                'id'               => 4,
                'vendor_id'        => 2,
                'is_active'        => '1',
                'name'             => 'Mutton Biriyani',
                'menu_id'          => '1',
                'item_category_id' => 5,
                'media_manager_id' => NULL,
                'preparation_time' => '20',
                'description'      => NULL,
                'product_addons'   => '[{"title":"Borhani","price":"70"},{"title":"Drinks","price":"40"}]',
                'created_by_id'    => 2,
                'updated_by_id'    => NULL,
                'deleted_by_id'    => NULL,
                'created_at'       => '2025-05-28 07:11:24',
                'updated_at'       => '2025-05-28 07:11:24',
                'deleted_at'       => NULL
            ),
        ));
        
        DB::table('product_attributes')->insert(array( 
            array(
                'id'                => '1',
                'is_active'         => '1',
                'product_id'        => '1',
                'title'             => 'Regular - 1:1',
                'price'             => '220',
                'discount_start_at' => NULL,
                'discount_end_at'   => NULL,
                'discount_type'     => NULL,
                'discount_value'    => '0',
                'discount_amount'   => '0',
                'discounted_price'  => '220',
                'created_at'        => '2025-05-28 06:59:03',
                'updated_at'        => '2025-05-28 07:00:22'
            ),
            array(
                'id'                => '2',
                'is_active'         => '1',
                'product_id'        => '1',
                'title'             => 'Extra - 1:3',
                'price'             => '650',
                'discount_start_at' => NULL,
                'discount_end_at'   => NULL,
                'discount_type'     => NULL,
                'discount_value'    => '0',
                'discount_amount'   => '0',
                'discounted_price'  => '650',
                'created_at'        => '2025-05-28 06:59:03',
                'updated_at'        => '2025-05-28 07:00:22'
            ),
            array(
                'id'                => '3',
                'is_active'         => '1',
                'product_id'        => '1',
                'title'             => 'Family - 1:5',
                'price'             => '1000',
                'discount_start_at' => NULL,
                'discount_end_at'   => NULL,
                'discount_type'     => NULL,
                'discount_value'    => '0',
                'discount_amount'   => '0',
                'discounted_price'  => '1000',
                'created_at'        => '2025-05-28 06:59:03',
                'updated_at'        => '2025-05-28 07:00:22'
            ),
            array(
                'id'                => '4',
                'is_active'         => '1',
                'product_id'        => '2',
                'title'             => 'Regular - 1:1',
                'price'             => '220',
                'discount_start_at' => NULL,
                'discount_end_at'   => NULL,
                'discount_type'     => NULL,
                'discount_value'    => '0',
                'discount_amount'   => '0',
                'discounted_price'  => '220',
                'created_at'        => '2025-05-28 07:11:24',
                'updated_at'        => '2025-05-28 07:11:24'
            ),
            array(
                'id'                => '5',
                'is_active'         => '1',
                'product_id'        => '2',
                'title'             => 'Extra - 1:3',
                'price'             => '650',
                'discount_start_at' => NULL,
                'discount_end_at'   => NULL,
                'discount_type'     => NULL,
                'discount_value'    => '0',
                'discount_amount'   => '0',
                'discounted_price'  => '650',
                'created_at'        => '2025-05-28 07:11:24',
                'updated_at'        => '2025-05-28 07:11:24'
            ),
            array(
                'id'                => '6',
                'is_active'         => '1',
                'product_id'        => '2',
                'title'             => 'Family 1:5',
                'price'             => '1000',
                'discount_start_at' => NULL,
                'discount_end_at'   => NULL,
                'discount_type'     => NULL,
                'discount_value'    => '0',
                'discount_amount'   => '0',
                'discounted_price'  => '1000',
                'created_at'        => '2025-05-28 07:11:24',
                'updated_at'        => '2025-05-28 07:11:24'
            ),

            array(
                'id'                => 7,
                'is_active'         => '1',
                'product_id'        => 3,
                'title'             => 'Regular - 1:1',
                'price'             => '220',
                'discount_start_at' => NULL,
                'discount_end_at'   => NULL,
                'discount_type'     => NULL,
                'discount_value'    => '0',
                'discount_amount'   => '0',
                'discounted_price'  => '220',
                'created_at'        => '2025-05-28 06:59:03',
                'updated_at'        => '2025-05-28 07:00:22'
            ),
            array(
                'id'                => 8,
                'is_active'         => '1',
                'product_id'        => 3,
                'title'             => 'Extra - 1:3',
                'price'             => '650',
                'discount_start_at' => NULL,
                'discount_end_at'   => NULL,
                'discount_type'     => NULL,
                'discount_value'    => '0',
                'discount_amount'   => '0',
                'discounted_price'  => '650',
                'created_at'        => '2025-05-28 06:59:03',
                'updated_at'        => '2025-05-28 07:00:22'
            ),
            array(
                'id'                => 9,
                'is_active'         => '1',
                'product_id'        => 3,
                'title'             => 'Family - 1:5',
                'price'             => '1000',
                'discount_start_at' => NULL,
                'discount_end_at'   => NULL,
                'discount_type'     => NULL,
                'discount_value'    => '0',
                'discount_amount'   => '0',
                'discounted_price'  => '1000',
                'created_at'        => '2025-05-28 06:59:03',
                'updated_at'        => '2025-05-28 07:00:22'
            ),
            array(
                'id'                => 10,
                'is_active'         => '1',
                'product_id'        => 4,
                'title'             => 'Regular - 1:1',
                'price'             => '220',
                'discount_start_at' => NULL,
                'discount_end_at'   => NULL,
                'discount_type'     => NULL,
                'discount_value'    => '0',
                'discount_amount'   => '0',
                'discounted_price'  => '220',
                'created_at'        => '2025-05-28 07:11:24',
                'updated_at'        => '2025-05-28 07:11:24'
            ),
            array(
                'id'                => 11,
                'is_active'         => '1',
                'product_id'        => 4,
                'title'             => 'Extra - 1:3',
                'price'             => '650',
                'discount_start_at' => NULL,
                'discount_end_at'   => NULL,
                'discount_type'     => NULL,
                'discount_value'    => '0',
                'discount_amount'   => '0',
                'discounted_price'  => '650',
                'created_at'        => '2025-05-28 07:11:24',
                'updated_at'        => '2025-05-28 07:11:24'
            ),
            array(
                'id'                => 12,
                'is_active'         => '1',
                'product_id'        => 4,
                'title'             => 'Family 1:5',
                'price'             => '1000',
                'discount_start_at' => NULL,
                'discount_end_at'   => NULL,
                'discount_type'     => NULL,
                'discount_value'    => '0',
                'discount_amount'   => '0',
                'discounted_price'  => '1000',
                'created_at'        => '2025-05-28 07:11:24',
                'updated_at'        => '2025-05-28 07:11:24'
            ),

        ));
    }
}
