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
        Schema::table('menus', function (Blueprint $table) {
            $table->foreignId("vendor_id")->constrained("users");
            $table->unique(["name","vendor_id"],"idx_menu_unique");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropUnique("idx_menu_unique");
            $table->dropForeign("menus_vendor_id_foreign");
            $table->dropColumn("vendor_id");
        });
    }
};
