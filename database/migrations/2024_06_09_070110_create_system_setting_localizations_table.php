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
        Schema::create('system_setting_localizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_setting_id')->constrained();
            $table->string('entity');
            $table->longText('value')->nullable();
            $table->string('lang_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_setting_localizations');
    }
};
