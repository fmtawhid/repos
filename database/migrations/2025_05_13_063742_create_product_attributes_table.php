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
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger("is_active")->default(1)->comment("1=Active, 2=Inactive");
            $table->foreignId("product_id")->constrained("products");

            $table->string("title");
            $table->double('price')->default(0.00);

            $table->datetime('discount_start_at')->nullable()->comment("Ex. Discount Start Date");
            $table->datetime('discount_end_at')->nullable()->comment("Ex. Discount End Date");

            $table->tinyInteger('discount_type')->nullable()->comment("1=Flat, 2=Percentage");
            $table->double('discount_value')->default(0.00)->comment("Ex. 10 Percent/Flat based on discount_type");
            $table->double('discount_amount')->default(0.00)->comment("Ex.20 as discount amount");

            $table->double('discounted_price')->default(0.00)->comment("Discounted Price of the product");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes');
    }
};
