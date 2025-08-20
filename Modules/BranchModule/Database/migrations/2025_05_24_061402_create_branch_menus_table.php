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
        Schema::create('branch_menus', function (Blueprint $table) {
            $table->id();

            $table->foreignId("branch_id")->constrained();
            $table->foreignId("menu_id")->constrained();
            $table->tinyInteger("is_active")->default(1)->comment("1=Active, 2=Inactive");

            $table->timestamps();

            $table->unique(['menu_id', 'branch_id'],"idx_branch_menu");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_menus');
    }
};
