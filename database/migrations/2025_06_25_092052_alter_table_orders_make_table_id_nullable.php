<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Step 1: Drop existing foreign key
            $table->dropForeign(['table_id']);
        });

        Schema::table('orders', function (Blueprint $table) {
            // Step 2: Make column nullable
            $table->unsignedBigInteger('table_id')->nullable()->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            // Step 3: Re-add foreign key constraint
            $table->foreign('table_id')->references('id')->on('tables')->nullOnDelete();
            // You can also use ->onDelete('set null') if preferred
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['table_id']);
            $table->unsignedBigInteger('table_id')->nullable(false)->change();
            $table->foreign('table_id')->references('id')->on('tables')->cascadeOnDelete();
        });
    }
};

