<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            // MediaManagerSeeder::class,
            SubscriptionPlanSeeder::class,
            PaymentGatewaySeed::class,
            StorageManagerSeeder::class,
            CurrencySeeder::class,
            LanguageSeeder::class,
            EmailTemplateSeeder::class,
            FAQSeeder::class,
            ModuleSeeder::class,
            SystemSettingSeeder::class,
            PermissionSeeder::class,
            PageSeeder::class,
            StatusSeed::class,

            // BranchSeeder::class,
            // KitchenSeeder::class,
            // AreaSeeder::class,
            // QrCodeSeeder::class,
            // TableSeeder::class,
            // ItemCategorySeeder::class,
            // MenuSeeder::class,
            // MenuItemSeeder::class,
        ]);
    }
}
