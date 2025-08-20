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
        Schema::table('areas', function (Blueprint $table) {
            $table->foreignId("vendor_id")->after("name")->constrained("users");
            $table->unique(["name","vendor_id"],"idx_area_unique");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropUnique("idx_area_unique");
            $table->dropForeign("areas_vendor_id_foreign");
            $table->dropColumn("vendor_id");
        });
    }
};
