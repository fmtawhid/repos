<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $statusArr = [
            "Completed"             => [1, 1, 1, 1, 'completed'],
            "Pending"               => [1, 1, 1, 1, 'pending'],
            "Cancelled"             => [1, 1, 1, 1, 'cancelled'],
            "Hold"                  => [1, 2, 1, 1, 'hold'],
            "Cooking - Pending"     => [1, 2, 1, 2, 'cooking_pending'],
            "Cooking - Ongoing"     => [1, 2, 1, 2, 'cooking_ongoing'],
            "Cooking - Completed"   => [1, 2, 1, 2, 'cooking_completed'],
            "Food Served"           => [2, 1, 1, 2, 'food_served'],
            "Ready for Pickup"      => [2, 1, 2, 2, 'ready_for_pickup'],
            "Out for Delivery"      => [2, 1, 2, 2, 'out_for_delivery'],
            "Delivery Boy Assigned" => [2, 1, 2, 2, 'delivery_boy_assigned'],
            "Delivered"             => [2, 1, 2, 2, 'delivered'],
        ];        
        
        foreach ($statusArr as $statusName => $accessArr) {       
            Status::query()->updateOrInsert(
                ['title' => $statusName],
                [
                    'kitchen_access'    => $accessArr[0],
                    'branch_access'     => $accessArr[1],
                    'order_access'      => $accessArr[2],
                    'reservation_access'=> $accessArr[3],
                    'context'           => $accessArr[4],
                    'updated_at'        => now(),
                    'created_at'        => now(), // optional, only for new records
                ]
            );
        }
    }
}
