<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use DB;
class KitchenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kitchens')->delete();
        DB::table('kitchens')->insert(array(
            array(
                'id'            => 1,
                'name'          => 'Kitchen One Branch One',
                'branch_id'     => '1',
                'vendor_id'     => '1',
                'is_active'     => '1',
                'created_by_id' => '1',
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-27 12:10:42',
                'updated_at'    => '2025-05-27 12:10:42',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => 2,
                'name'          => 'Kitchen One Branch Two',
                'branch_id'     => '2',
                'vendor_id'     => '1',
                'is_active'     => '1',
                'created_by_id' => '1',
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-27 12:11:06',
                'updated_at'    => '2025-05-27 12:11:06',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => 3,
                'name'          => 'Kitchen Two Branch One',
                'branch_id'     => '1',
                'vendor_id'     => '1',
                'is_active'     => '1',
                'created_by_id' => '1',
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-27 12:11:26',
                'updated_at'    => '2025-05-27 12:11:26',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => 4,
                'name'          => 'Kitchen Two Branch Two',
                'branch_id'     => '2',
                'vendor_id'     => '1',
                'is_active'     => '1',
                'created_by_id' => '1',
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-27 12:11:41',
                'updated_at'    => '2025-05-27 12:11:41',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => 5,
                'name'          => 'Vendor Kitchen One',
                'branch_id'     => '3',
                'vendor_id'     => '2',
                'is_active'     => '1',
                'created_by_id' => 2,
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-27 12:11:41',
                'updated_at'    => '2025-05-27 12:11:41',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => 6,
                'name'          => 'Vendor Kitchen Two',
                'branch_id'     => '3',
                'vendor_id'     => '2',
                'is_active'     => '1',
                'created_by_id' => 2,
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-27 12:11:41',
                'updated_at'    => '2025-05-27 12:11:41',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => 7,
                'name'          => 'Vendor Kitchen Three',
                'branch_id'     => '4',
                'vendor_id'     => '2',
                'is_active'     => '1',
                'created_by_id' => 2,
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-27 12:11:41',
                'updated_at'    => '2025-05-27 12:11:41',
                'deleted_at'    => NULL
            ),
            array(
                'id'            => 8,
                'name'          => 'Vendor Kitchen Four',
                'branch_id'     => '4',
                'vendor_id'     => '2',
                'is_active'     => '1',
                'created_by_id' => 2,
                'updated_by_id' => NULL,
                'deleted_by_id' => NULL,
                'created_at'    => '2025-05-27 12:11:41',
                'updated_at'    => '2025-05-27 12:11:41',
                'deleted_at'    => NULL
            ),
            
        ));
    }
}
