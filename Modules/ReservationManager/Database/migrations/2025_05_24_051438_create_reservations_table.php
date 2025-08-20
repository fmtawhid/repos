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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->foreignId("status_id")->constrained("statuses");
            $table->foreignId('branch_id')->constrained("branches");
            $table->foreignId('vendor_id')->constrained("users");
            $table->foreignId('customer_id')->constrained("users");

            $table->dateTime("start_datetime")->nullable()->comment("Reservation start time");
            $table->dateTime("end_datetime")->nullable()->comment("Reservation start time");

            $table->integer("number_of_guests")->default(0)->comment("Number of guests");

            $table->tinyInteger("is_paid")->default(0)->comment("0=not paid, 1=paid");

            $table->double("advance_reservation_payment")->default(0);
            $table->double("total_reservation_amount")->default(0);
            $table->double("due_reservation_payment")->default(0);

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
        Schema::dropIfExists('reservations');
    }
};
