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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("has_monthly_limit")->default(0)->comment("Applicable for the yearly & lifetime package only. Not applicable for the prepaid/monthly");
            $table->string("title");
            $table->string("slug");
            $table->foreignId("user_id")->constrained();
            $table->integer('duration')->nullable()->default(30);
            $table->string('description')->nullable();
            $table->string('package_type')->default('monthly')->comment('starter/monthly/yearly/lifetime/prepaid');
            $table->double('price')->default('0.00');
            $table->double('discount_price')->nullable();
            $table->integer('discount_type')->nullable()->comment('1=fixed, 2=percentage');
            $table->double('discount')->nullable();
            $table->integer('discount_status')->nullable();
            $table->date('discount_start_date')->nullable();
            $table->date('discount_end_date')->nullable();

            // branches
            $table->tinyInteger('allow_unlimited_branches')->nullable()->default(0);
            $table->bigInteger('total_branches')->default(0);
            
            // kitchen
            $table->tinyInteger('allow_kitchen_panel')->nullable()->default(1);           
            $table->tinyInteger('show_kitchen_panel')->nullable()->default(1);  
            
            // reservations
            $table->tinyInteger('allow_reservations')->nullable()->default(1);           
            $table->tinyInteger('show_reservations')->nullable()->default(1);  
            
            // support & other features
            $table->tinyInteger('allow_support')->default(0);
            $table->tinyInteger('show_support')->default(1);
            
            // team
            $table->tinyInteger('allow_team')->default(0);
            $table->tinyInteger('show_team')->default(0);

            $table->tinyInteger('is_featured')->default(0);
            $table->longText('other_features')->nullable();
            
            // common columns
            $table->tinyInteger("is_active")->default(1)->comment("1=Active,0=Inactive");
            $table->foreignId("created_by_id")->nullable()->constrained("users");
            $table->foreignId("updated_by_id")->nullable()->constrained("users");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
