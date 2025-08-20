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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("is_active")->default(1)->comment("1=Active, 2=Inactive");
            $table->foreignId("vendor_id")->constrained("users");

            $table->string('name');
            $table->string("branch_code");
            $table->string('mobile_no')->nullable();
            $table->string("email")->nullable();
            $table->text("address")->nullable();

            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
            $table->text("map_link")->nullable();
            $table->time("open_time")->nullable();
            $table->time("close_time")->nullable();
            $table->string("business_days")->nullable()->comment("Ex. Sat-Thu");

            $table->foreignId("created_by_id")->nullable()->constrained("users");
            $table->foreignId("updated_by_id")->nullable()->constrained("users");
            $table->foreignId("deleted_by_id")->nullable()->constrained("users");
            $table->timestamps();
            $table->softDeletes();

            $table->unique(["vendor_id", "branch_code"],"idx_branch_code");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
