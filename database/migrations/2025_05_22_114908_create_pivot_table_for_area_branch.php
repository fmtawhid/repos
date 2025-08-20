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
        Schema::create('area_branch', function (Blueprint $table) {
            $table->id();

            $table->foreignId('area_id')->constrained()->onDelete('cascade');
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->tinyInteger("is_active")->default(1)->comment("1=Active, 2=Inactive");

            $table->unique(['area_id', 'branch_id'],"idx_branch_area");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_branch');
    }
};
