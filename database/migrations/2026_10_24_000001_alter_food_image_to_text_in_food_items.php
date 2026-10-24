<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('foodItems', function (Blueprint $table) {
            $table->text('food_image')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('foodItems', function (Blueprint $table) {
            $table->string('food_image', 255)->nullable()->change();
        });
    }
};
