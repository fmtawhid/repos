<?php

use App\Models\StorageManager;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('storage_managers', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('access_key')->nullable();
            $table->string('secret_key')->nullable();
            $table->string('bucket')->nullable();
            $table->string('region')->nullable();
            $table->string('container')->nullable();
            $table->string('storage_name')->nullable();
            $table->string('storage_url')->nullable();
            $table->string('file_name')->nullable();
            $table->string('path')->nullable();
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
        Schema::dropIfExists('storage_managers');
    }
};
