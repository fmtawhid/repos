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
        Schema::create('vendor_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("vendor_id")->constrained("users");
            $table->foreignId("customer_id")->constrained("users");
            $table->foreignId("branch_id")->constrained("branches");
            $table->bigInteger("order_times")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_customers');
    }
};
