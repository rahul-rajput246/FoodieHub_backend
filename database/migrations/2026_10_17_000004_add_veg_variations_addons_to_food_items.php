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
        Schema::table('foodItems', function (Blueprint $table) {
            if (!Schema::hasColumn('foodItems', 'is_veg')) {
                $table->boolean('is_veg')->default(true)->after('food_type');
            }
            if (!Schema::hasColumn('foodItems', 'variations')) {
                $table->json('variations')->nullable()->after('food_old_price');
            }
            if (!Schema::hasColumn('foodItems', 'addons')) {
                $table->json('addons')->nullable()->after('variations');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('foodItems', function (Blueprint $table) {
            $table->dropColumn(['is_veg', 'variations', 'addons']);
        });
    }
};
