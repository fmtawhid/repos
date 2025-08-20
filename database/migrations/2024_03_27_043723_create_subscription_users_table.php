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
        Schema::create('subscription_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("subscription_plan_id")->constrained();            
            $table->integer("subscription_status")->nullable()->comment('1=active, 2=expired, 3=subscribed, 4=pending');
            
            $table->dateTime("start_at")->nullable()->comment("Subscription Starting date");
            $table->dateTime("expire_at")->nullable()->comment("Subscription expire date");
            $table->tinyInteger("has_monthly_limit")->default(0)->comment("Applicable for the yearly & lifetime package only. Not applicable for the prepaid/monthly");
            
            
            $table->double("price")->default(0);
            $table->double("discount")->default(0);
            $table->integer('discount_type')->nullable();
            
            $table->integer('forcefully_active')->nullable();
            $table->tinyInteger('is_recurring')->nullable()->default(0);
            $table->tinyInteger('is_carried_over')->nullable()->default(0);
            $table->string("order_id")->nullable();
            $table->integer('offline_payment_id')->nullable();
            $table->foreignId("payment_gateway_id")->nullable()->constrained("payment_gateways");
            $table->string("payment_method")->default(0);
            $table->longText("payment_details")->nullable();
            $table->string('currency_code')->nullable()->default(0);
            $table->text("file")->nullable();
            $table->longText("note")->nullable();
            $table->longText("feedback_note")->nullable();

            $table->integer("payment_status")->nullable()->comment('1=paid, 2=Pending, 3=Rejected 4=Re-Submit');
            

            $table->dateTime("expire_by_admin_date")->nullable()->comment("Subscription expire by admin date");
            $table->tinyInteger("is_active")->default(1)->comment("1=Active,0=Inactive");
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
        Schema::dropIfExists('subscription_users');
    }
};
