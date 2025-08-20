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
        Schema::table('order_products', function (Blueprint $table) {
            $table->foreignId("product_owner_id")->after("product_id")->constrained("users");

            $table->json("product_json")->nullable()->after("product_owner_id");
            $table->json("product_attribute_json")->nullable()->after("product_json");
            $table->json("product_addons")->nullable()->after("product_json");

            $table->tinyInteger("discount_type")->default(0)->comment("1=Flat, 2=Percentage")->after("sub_total");
            $table->double("discount_value")->default(0)->after("discount_type");
            $table->double("discount_amount")->default(0)->after("discount_value");
            $table->double("shipping_cost")->default(0)->after("discount_amount");
            $table->double("total_price")->default(0)->after("shipping_cost");
            $table->tinyInteger("is_refund")->default(2)->comment("1=Refund, 2=Not Refunded")->after("total_price");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_products', function (Blueprint $table) {

            $table->dropForeign("order_products_product_owner_id_foreign");

            $table->dropColumn("product_owner_id");
            $table->dropColumn("product_json");
            $table->dropColumn("product_addons");
            $table->dropColumn("discount_type");
            $table->dropColumn("discount_value");
            $table->dropColumn("discount_amount");
            $table->dropColumn("shipping_cost");
            $table->dropColumn("total_price");
            $table->dropColumn("is_refund");
        });
    }
};
