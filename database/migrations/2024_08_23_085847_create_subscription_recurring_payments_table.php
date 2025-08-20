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
        Schema::create('subscription_recurring_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('subscription_user_usage_id')->nullable();
            $table->string('billing_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('price_id')->nullable();
            $table->string('gateway_subscription_id')->nullable();
            $table->string('gateway')->nullable();
            $table->text('reason')->nullable();
            $table->string('status')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('cancel_by')->nullable();
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
        Schema::dropIfExists('subscription_recurring_payments');
    }
};
