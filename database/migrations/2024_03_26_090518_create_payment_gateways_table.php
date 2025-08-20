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
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('gateway');
            $table->string('image')->nullable();
            $table->boolean('is_recurring')->nullable()->default(false);
            $table->string('webhook_id')->nullable();
            $table->string('webhook_secret')->nullable();
            $table->boolean('sandbox')->nullable()->default(false);
            $table->string('type')->nullable()->comment('sandbox, live');            
            $table->string('service_charge')->nullable()->default(false);
            $table->string('charge_type')->nullable()->comment('1= flat, 2=percentage');
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
        Schema::dropIfExists('payment_gateways');
    }
};
