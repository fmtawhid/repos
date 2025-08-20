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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id")->constrained("orders");
            $table->foreignId("product_id")->constrained("products");
            $table->foreignId("product_attribute_id")->constrained("product_attributes");

            $table->double("qty")->default(0);
            $table->double("price")->default(0);
            $table->double("sub_total")->default(0);

            $table->tinyInteger("is_cancel")->default(2)->comment("1=Canceled , 2=Not Canceled from order");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
