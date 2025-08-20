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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->tinyInteger("is_active")->default(1)->comment("1=Active, 2=Inactive");
            $table->text("icon")->nullable();

            $table->tinyInteger("kitchen_access")->default(2)->comment("1=Yes, 2=No");
            $table->tinyInteger("branch_access")->default(2)->comment("1=Yes, 2=No");
            $table->tinyInteger("order_access")->default(2)->comment("1=Yes, 2=No");
            $table->tinyInteger("reservation_access")->default(2)->comment("1=Yes, 2=No");

            $table->foreignId("created_by_id")->nullable()->constrained("users");
            $table->foreignId("updated_by_id")->nullable()->constrained("users");
            $table->foreignId("deleted_by_id")->nullable()->constrained("users");
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
