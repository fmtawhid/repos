<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parent_user_id')->nullable()->constrained("users");

            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('mobile_no')->nullable();

            $table->tinyInteger('user_type')->comment("1=Admin, 2=Admin Agent, 3=Vendor, 31=Vendor team, 4=Customer");

            $table->string('password');
            $table->string('avatar')->nullable();

            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('menu_permission_version')->default(0);

            $table->dateTime("last_login_at")->nullable();
            $table->dateTime("last_logout_at")->nullable();

            $table->unsignedBigInteger('subscription_plan_id')->nullable();

            $table->string('verification_code')->nullable();
            $table->string('verification_code_expired_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider_type')->nullable();
            $table->double('user_balance')->default('0.00');
            $table->string('referral_code')->nullable();
            $table->integer('num_of_clicks')->default(0);
            $table->string('referred_user_id')->nullable();
            $table->tinyInteger('is_commission_calculated')->default(1);
            $table->rememberToken();

            $table->tinyInteger("account_status")->default(1)->comment("1=Active,2=Inactive");

            $table->foreignId("created_by_id")->nullable()->constrained("users");
            $table->foreignId("updated_by_id")->nullable()->constrained("users");
            $table->foreignId("deleted_by_id")->nullable()->constrained("users");

            $table->datetimes();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
