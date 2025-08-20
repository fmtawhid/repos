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
        Schema::table('products', function (Blueprint $table) {
            $table->double('total_sales_amount')->default(0.00)->after('product_addons');
            $table->bigInteger('total_sales_count')->default(0)->after('total_sales_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn("total_sales_amount");
            $table->dropColumn("total_sales_count");
        });
    }
};
