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
        Schema::create('payment_gateway_product_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_plan_id')->nullable()->constrained();
            $table->string('subscription_plan_name')->nullable();
            $table->string('gateway')->nullable();          
            $table->string('old_product_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('old_billing_id')->nullable();  
            $table->string('new_billing_id')->nullable();
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
        Schema::dropIfExists('payment_gateway_product_histories');
    }
};
