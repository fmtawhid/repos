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
        Schema::create('carts', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('product_attribute_id')->constrained();
            $table->integer('qty');
            $table->foreignId('created_by_id')->nullable()->comment("NB: Creator of the record")->constrained("users");
            $table->foreignId('updated_by_id')->nullable()->comment("NB: Updater of the record")->constrained("users");
            $table->foreignId('deleted_by_id')->nullable()->comment("NB: Deleter of the record")->constrained("users");

            $table->timestamps();

            $table->unique(["user_id","product_id","product_attribute_id"],"idx_prod_user");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
