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
        Schema::create('assign_tickets', function (Blueprint $table) {
            $table->id();          
            $table->foreignId("ticket_id")->nullable()->constrained("tickets");
            $table->foreignId("assign_user_id")->nullable()->constrained("users");
            $table->datetimes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_tickets');
    }
};
