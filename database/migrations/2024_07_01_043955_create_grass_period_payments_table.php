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
        Schema::create('grass_period_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->string('order_id')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('status_code')->nullable();
            $table->foreignId('subscription_plan_id')->nullable()->constrained();
            $table->longText('response')->nullable();
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
        Schema::dropIfExists('grass_period_payments');
    }
};
