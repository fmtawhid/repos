<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Modules\BranchModule\App\Services\BranchService;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user   = User::query()->where('email', 'admin@themetags.com')->first();
        $vendor = User::query()->where('email', 'vendor@themetags.com')->first();

        if(empty($user)) {
            DB::table('users')->insert([
                'first_name'        => 'Admin',
                'account_status'    => 1,
                'user_type'         => 1,
                'email'             => 'admin@themetags.com',
                'branch_id'         => null,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'password'          => bcrypt(1234567),
                'created_at'        => date("Y-m-d H:i:s"),
            ]);
        }

        // create a Test Vendor
        if(empty($vendor)) {
            DB::table('users')->insert([
                'first_name'        => 'MR. Test Vendor',
                'account_status'    => 1,
                'user_type'         => appStatic()::TYPE_VENDOR,
                'email'             => 'vendor@themetags.com',
                'branch_id'         => null,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'password'          => bcrypt(1234567),
                'created_at'        => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
