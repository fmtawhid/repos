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
        Schema::create('subscription_user_usages', function (Blueprint $table) {
            $table->id();

            $table->foreignId("user_id")->constrained();
            $table->foreignId("subscription_user_id")->constrained();
            $table->foreignId("subscription_plan_id")->constrained();
            $table->integer("subscription_status")->nullable()->comment('1=active, 2=expired, 3=subscribed, 4=pending');

            $table->string("platform")->default(1);

            $table->tinyInteger("has_monthly_limit")->default(0)->comment("Applicable for the yearly & lifetime package only. Not applicable for the prepaid/monthly");

            $table->dateTime("start_at");
            $table->dateTime("expire_at");

            // branches 
            $table->tinyInteger('allow_unlimited_branches')->nullable()->default(0);
            $table->integer("branch_balance")->default(0);
            $table->integer("branch_balance_used")->default(0);
            $table->integer("branch_balance_remaining")->default(0);

            // kitchen
            $table->tinyInteger('allow_kitchen_panel')->nullable()->default(0);

            // reservations
            $table->tinyInteger('allow_reservations')->nullable()->default(0);

            // support
            $table->tinyInteger('allow_support')->nullable()->default(0);

            // team
            $table->tinyInteger('allow_team')->nullable()->default(0);
            
            $table->tinyInteger("is_active")->default(0)->comment("1=Active,0=Inactive");
            $table->foreignId("created_by_id")->nullable()->constrained("users");
            $table->foreignId("updated_by_id")->nullable()->constrained("users");
            $table->datetimes();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_user_usages');
    }
};
