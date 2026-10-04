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
        Schema::create('home_edit' , function(Blueprint $table){
            $table->id();
            
            // Home Banner

            $table->string('home_banner_subtitle')->nullable();
            $table->string('home_banner_title1')->nullable();
            $table->string('home_banner_title2')->nullable();
            $table->string('home_banner_color_title')->nullable();
            $table->string('home_banner_desc')->nullable();
            $table->string('home_banner_btn_text1')->nullable();
            $table->string('home_banner_btn_url1')->nullable();
            $table->string('home_banner_btn_text2')->nullable();
            $table->string('home_banner_btn_url2')->nullable();
            $table->string('home_banner_img')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_edit');
    }
};