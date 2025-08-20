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
        Schema::create('webhook_histories', function (Blueprint $table) {
            $table->id();
            $table->string('gateway')->nullable()->comment("ex. stripe/paypal etc");
            $table->string('webhook_id')->nullable();
            $table->string('stripe_product_id')->nullable();
            $table->string('stripe_plan')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('create_time')->nullable();
            $table->string('resource_type')->nullable();
            $table->string('event_type')->nullable();
            $table->string('summary')->nullable();
            $table->string('resource_id')->nullable();
            $table->string('resource_state')->nullable();
            $table->string('parent_payment')->nullable();
            $table->string('amount_total')->nullable();
            $table->string('amount_currency')->nullable();
            $table->text('incoming_json')->nullable();
            $table->string('status')->nullable();
            $table->json("hook_payloads")->nullable();
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
        Schema::dropIfExists('webhook_histories');
    }
};
