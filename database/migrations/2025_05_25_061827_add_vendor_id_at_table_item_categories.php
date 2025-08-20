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
        Schema::table('item_categories', function (Blueprint $table) {
            $table->foreignId("vendor_id")->after("name")->constrained("users");

            $table->unique(["name","vendor_id"],"idx_item_category_unique");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_categories', function (Blueprint $table) {
            $table->dropForeign("item_categories_vendor_id_foreign");
            $table->dropUnique("idx_item_category_unique");
            $table->dropColumn("vendor_id");
        });
    }
};
