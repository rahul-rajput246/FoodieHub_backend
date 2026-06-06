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

            $table->string('home_banner_subtitle');
            $table->string('home_banner_title1');
            $table->string('home_banner_title2');
            $table->string('home_banner_color_title');
            $table->string('home_banner_desc');
            $table->string('home_banner_btn_text1');
            $table->string('home_banner_btn_url1');
            $table->string('home_banner_btn_text2');
            $table->string('home_banner_btn_url2');
            $table->string('home_banner_img');

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