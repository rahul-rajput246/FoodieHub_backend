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
        Schema::table('cart_items', function (Blueprint $table) {
            // Add individual indexes so foreign keys remain valid when dropping the composite unique index
            $table->index('user_id', 'cart_items_user_id_idx');
            $table->index('food_item_id', 'cart_items_food_item_id_idx');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            try {
                $table->dropUnique('cart_items_user_id_food_item_id_unique');
            } catch (\Throwable $e) {
                // Ignore if already dropped
            }

            if (!Schema::hasColumn('cart_items', 'cart_key')) {
                $table->string('cart_key', 64)->nullable()->after('food_item_id');
            }
            if (!Schema::hasColumn('cart_items', 'selected_variation')) {
                $table->json('selected_variation')->nullable()->after('quantity');
            }
            if (!Schema::hasColumn('cart_items', 'selected_addons')) {
                $table->json('selected_addons')->nullable()->after('selected_variation');
            }
            if (!Schema::hasColumn('cart_items', 'item_price')) {
                $table->decimal('item_price', 10, 2)->nullable()->after('selected_addons');
            }
        });

        Schema::table('order_items', function (Blueprint $table) {
            if (!Schema::hasColumn('order_items', 'selected_variation')) {
                $table->json('selected_variation')->nullable()->after('subtotal');
            }
            if (!Schema::hasColumn('order_items', 'selected_addons')) {
                $table->json('selected_addons')->nullable()->after('selected_variation');
            }
            if (!Schema::hasColumn('order_items', 'customization_summary')) {
                $table->string('customization_summary')->nullable()->after('selected_addons');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn(['cart_key', 'selected_variation', 'selected_addons', 'item_price']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['selected_variation', 'selected_addons', 'customization_summary']);
        });
    }
};
