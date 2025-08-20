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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string("display_title");
            $table->string("route");
            $table->string("url");
            $table->string("method_type")->comment("Ex: Get/POST/PUT/DELETE/PATCH ETC");
            $table->tinyInteger("is_sidebar_menu")->default(0)->comment("1= For Sidebar show-able menu, 0 = Not show-able for sidebar");
            $table->string("icon_file")->nullable()->comment("Ex. icon_file could be image or icon library ref.");
            
            $table->foreignId("user_id")->constrained();
            $table->tinyInteger("is_active")->default(1)->comment("1=Active,0=Inactive");
            $table->foreignId("created_by_id")->nullable()->constrained("users");
            $table->foreignId("updated_by_id")->nullable()->constrained("users");
            $table->datetimes();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
