<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {            
            $table->enum('payment_method', ['cod', 'cash', 'card'])->nullable()->after('discount_type')->comment('cod=cash on delivery, cash=cash, card=card payment');            
            $table->boolean('is_paid')->default(0)->after('payment_method')->comment('1=paid, 0=not paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'is_paid']);
        });
    }
};
