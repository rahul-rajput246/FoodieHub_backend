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
        Schema::create('foodItems' , function(Blueprint $table){
            $table->id();
            $table->string('food_name')->nullable();
            $table->string('food_subtitle')->nullable();
            $table->string('food_slug')->unique()->nullable();
            $table->text('food_desc')->nullable();
            $table->string('food_image')->nullable();
            $table->string('food_type')->nullable();
            $table->integer('food_stock')->nullable();
            $table->decimal('food_price' , 8 , 2)->nullable();
            $table->decimal('food_old_price', 8 , 2)->nullable();
            $table->decimal('food_rating' , 2 , 1)->default(0);
            $table->string('food_preparation_time')->nullable();
            $table->boolean('food_is_popular')->default(false);
            $table->boolean('food_category')->default(false);
            $table->boolean('food_is_featured')->default(false);
            $table->boolean('food_status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foodItems');
    }
};
