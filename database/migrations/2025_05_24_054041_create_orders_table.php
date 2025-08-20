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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->string("invoice_no")->unique();

            $table->tinyInteger("is_online_order")->default(2)->comment("1=Online, 2=Offline/Branch");
            $table->tinyInteger("is_take_way_order")->default(2)->comment("1=takeway, 2=not takeway");
            $table->string("online_platform")->nullable()->comment("Ex. FoodPanda, FoodX");

            $table->foreignId("vendor_id")->constrained("users");
            $table->foreignId("branch_id")->constrained();
            $table->foreignId("table_id")->constrained();
            $table->foreignId("status_id")->constrained();

            $table->integer("total_qty")->default(0);

            $table->double("total")->default(0);

            $table->tinyInteger("discount_type")->default(0)->comment("1=Flat, 2=Percent");

            $table->double("discount_value")->default(0);
            $table->double("discounted_amount")->default(0);
            $table->double("payable_after_discount")->default(0);
            $table->double("paid_amount")->default(0);

            $table->text("customer_note")->nullable();
            $table->text("kitchen_note")->nullable();

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
        Schema::dropIfExists('orders');
    }
};
