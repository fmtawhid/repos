<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscription_plans')->delete();
        
        $subscription_plans = array(
            array('id' => '1','has_monthly_limit' => '0','title' => 'Starter','slug' => 'new-plan-O7G0G7Y9n0X0P3k','user_id' => '1','duration' => '30','description' => 'Get started with our new package','package_type' => 'starter','price' => '0','discount_price' => NULL,'discount_type' => NULL,'discount' => NULL,'discount_status' => NULL,'discount_start_date' => NULL,'discount_end_date' => NULL,'allow_unlimited_branches' => '0','total_branches' => '5','allow_kitchen_panel' => '0','show_kitchen_panel' => '1','allow_reservations' => '0','show_reservations' => '1','allow_support' => '1','show_support' => '1','allow_team' => '1','show_team' => '1','is_featured' => '0','other_features' => NULL,'is_active' => '1','created_by_id' => '1','updated_by_id' => '1','created_at' => '2025-05-31 10:53:55','updated_at' => '2025-05-31 11:32:26','deleted_at' => NULL),
            array('id' => '2','has_monthly_limit' => '0','title' => 'Basic','slug' => 'new-plan-O7G0G7Y9n0X0P3k','user_id' => '1','duration' => '30','description' => 'Get started with our basic package','package_type' => 'monthly','price' => '10','discount_price' => NULL,'discount_type' => NULL,'discount' => NULL,'discount_status' => NULL,'discount_start_date' => NULL,'discount_end_date' => NULL,'allow_unlimited_branches' => '0','total_branches' => '5','allow_kitchen_panel' => '1','show_kitchen_panel' => '1','allow_reservations' => '1','show_reservations' => '1','allow_support' => '1','show_support' => '1','allow_team' => '1','show_team' => '1','is_featured' => '1','other_features' => NULL,'is_active' => '1','created_by_id' => '1','updated_by_id' => '1','created_at' => '2025-05-31 11:31:56','updated_at' => '2025-05-31 11:32:58','deleted_at' => NULL),
            array('id' => '3','has_monthly_limit' => '0','title' => 'Basic','slug' => 'new-plan-O7G0G7Y9n0X0P3k','user_id' => '1','duration' => '30','description' => 'Get started with our unlimited package','package_type' => 'yearly','price' => '100','discount_price' => NULL,'discount_type' => NULL,'discount' => NULL,'discount_status' => NULL,'discount_start_date' => NULL,'discount_end_date' => NULL,'allow_unlimited_branches' => '1','total_branches' => '5','allow_kitchen_panel' => '1','show_kitchen_panel' => '1','allow_reservations' => '1','show_reservations' => '1','allow_support' => '1','show_support' => '1','allow_team' => '1','show_team' => '1','is_featured' => '1','other_features' => NULL,'is_active' => '1','created_by_id' => '1','updated_by_id' => '1','created_at' => '2025-05-31 11:33:22','updated_at' => '2025-05-31 11:33:41','deleted_at' => NULL)
        );

        DB::table('subscription_plans')->insert($subscription_plans);
    }
}

