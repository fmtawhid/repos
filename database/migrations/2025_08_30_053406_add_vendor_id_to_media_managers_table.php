<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('media_managers', function (Blueprint $table) {
            if (!Schema::hasColumn('media_managers', 'vendor_id')) {
                $table->unsignedBigInteger('vendor_id')->nullable()->after('id')->index();
            }
        });
    }

    public function down(): void
    {
        Schema::table('media_managers', function (Blueprint $table) {
            if (Schema::hasColumn('media_managers', 'vendor_id')) {
                $table->dropColumn('vendor_id');
            }
        });
    }
};
