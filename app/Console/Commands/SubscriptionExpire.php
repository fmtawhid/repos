<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SubscriptionUser;

class SubscriptionExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscription Plan Expire';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = date('Y-m-d');
        $allActivePackageHistory = SubscriptionUser::where('subscription_status', 1)->whereNotNull('expire_at')->get();
        foreach ($allActivePackageHistory as $activePackageHistory) {
            $expire_at = date('Y-m-d', strtotime($activePackageHistory->expire_at));
            if ($today > $expire_at) {
                $activePackageHistory->update(['subscription_status' => 2]);
            }
        }
        $allSubscriptPackageHistory = SubscriptionUser::where('subscription_status', 3)->where('payment_status', 1)->whereNotNull('start_at')->get();
        foreach ($allSubscriptPackageHistory as $activePackageHistory) {
            $package = $activePackageHistory->subscriptionPackage;
            $packageType = '';
            $expire_at = date('Y-m-d', strtotime($activePackageHistory->expire_at));
            $start_at = date('Y-m-d', strtotime($activePackageHistory->start_at));

            if (!is_null($package)) {
                $packageType = $package->package_type;
            }
            if (!empty($packageType) && in_array($packageType, ["prepaid", "lifetime"]) && $today >= $start_at) {
                $activePackageHistory->update(['subscription_status' => 1]);
            } else if (!empty($packageType) && !in_array($packageType, ["prepaid", "lifetime"]) && $today >= $start_at && $today <= $expire_at) {
                $activePackageHistory->update(['subscription_status' => 1]);
            }
        }
    }
}
