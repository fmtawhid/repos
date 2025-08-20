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
        Schema::create('client_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('avatar')->nullable();
            $table->string('designation')->nullable();
            $table->string('heading')->nullable();
            $table->integer('rating');
            $table->text('review')->nullable();
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
        Schema::dropIfExists('client_feedback');
    }
};
