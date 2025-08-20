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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->string("transaction_no")->unique();

            $table->foreignId("vendor_id")->constrained("users");
            $table->foreignId("branch_id")->nullable()->constrained("users");

            $table->foreignId("order_id")->nullable()->constrained("orders");
            $table->foreignId("reservation_id")->nullable()->constrained("orders");

            $table->double("paid_amount")->default(0);
            $table->string("payment_method");
            $table->foreignId("status_id")->comment("Ex. Status id wise track success/pending/declined payment")->constrained("statuses");

            $table->text("note")->nullable();

            $table->foreignId("created_by_id")->nullable()->constrained("users");
            $table->foreignId("updated_by_id")->nullable()->constrained("users");
            $table->foreignId("deleted_by_id")->nullable()->constrained("users");

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
