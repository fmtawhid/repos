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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained("users");
            $table->tinyInteger("is_active")->default(1)->comment("1=Active,0=Inactive");

            $table->string('name')->nullable()->comment('Name of the menu items');

            $table->foreignId('menu_id')->nullable()->constrained();

            $table->foreignId('item_category_id')->nullable()->constrained('item_categories');
            $table->foreignId('media_manager_id')->nullable()->constrained('media_managers');

            $table->integer('preparation_time')->default(0)->comment('preparation time in minutes');
            $table->longText('description')->nullable();

            $table->json("product_addons")->nullable();

            $table->foreignId("created_by_id")->nullable()->constrained("users");
            $table->foreignId("updated_by_id")->nullable()->constrained("users");
            $table->foreignId("deleted_by_id")->nullable()->constrained("users");

            $table->datetimes();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
