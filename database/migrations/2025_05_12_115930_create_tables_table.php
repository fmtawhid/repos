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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();            
            $table->string('table_code')->nullable();            
            $table->foreignId('area_id')->nullable()->constrained('areas');
            $table->integer('number_of_seats')->nullable()->default(0)->comment('seats of this table');                       
            $table->tinyInteger("is_active")->default(1)->comment("1=Active,0=Inactive");
            $table->foreignId("created_by_id")->nullable()->constrained("users")->after('created_at');
            $table->foreignId("updated_by_id")->nullable()->constrained("users")->after('updated_at');
            $table->datetimes();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
