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
        Schema::create('payment_gateway_products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('subscription_plan_id')->default(0);
            $table->string('package_name')->nullable();
            $table->string('gateway')->nullable();          
            $table->string('product_id')->nullable();
            $table->string('billing_id')->nullable();
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
        Schema::dropIfExists('payment_gateway_products');
    }
};
