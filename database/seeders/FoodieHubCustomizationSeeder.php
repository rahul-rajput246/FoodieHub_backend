<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\FoodItems;

class FoodieHubCustomizationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Update existing items
        // Item 1: Chole Masala (Veg)
        FoodItems::where('id', 1)->update([
            'is_veg' => true,
            'food_type' => '0',
            'variations' => [
                ['id' => 'half', 'name' => 'Half Handi (Serves 1)', 'price' => 0],
                ['id' => 'full', 'name' => 'Full Handi (Serves 2-3)', 'price' => 60],
            ],
            'addons' => [
                ['id' => 'b1', 'name' => 'Butter Tandoori Roti (2 Pcs)', 'price' => 30, 'is_veg' => true],
                ['id' => 'b2', 'name' => 'Garlic Naan (1 Pc)', 'price' => 40, 'is_veg' => true],
                ['id' => 'b3', 'name' => 'Boondi Raita', 'price' => 35, 'is_veg' => true],
            ],
        ]);

        // Item 2: Mint Mojito (Veg)
        FoodItems::where('id', 2)->update([
            'is_veg' => true,
            'food_type' => '2',
            'variations' => [
                ['id' => 'reg', 'name' => 'Regular Glass (350ml)', 'price' => 0],
                ['id' => 'lrg', 'name' => 'Jumbo Cooler (500ml)', 'price' => 40],
            ],
            'addons' => [
                ['id' => 'm1', 'name' => 'Extra Fresh Mint & Lime', 'price' => 15, 'is_veg' => true],
                ['id' => 'm2', 'name' => 'Popping Boba Pearls', 'price' => 25, 'is_veg' => true],
            ],
        ]);

        // Item 3: Sandwich (Veg)
        FoodItems::where('id', 3)->update([
            'is_veg' => true,
            'food_type' => '0',
            'variations' => [
                ['id' => 'grilled', 'name' => 'Classic Grilled Toast', 'price' => 0],
                ['id' => 'triple', 'name' => 'Triple-Decker Cheese Burst', 'price' => 45],
            ],
            'addons' => [
                ['id' => 's1', 'name' => 'Extra Melted Cheese', 'price' => 25, 'is_veg' => true],
                ['id' => 's2', 'name' => 'Tandoori Mayo Dip', 'price' => 20, 'is_veg' => true],
                ['id' => 's3', 'name' => 'Golden French Fries Add-on', 'price' => 49, 'is_veg' => true],
            ],
        ]);

        // Item 5: Classic Veg Burger (Veg)
        FoodItems::where('id', 5)->update([
            'is_veg' => true,
            'food_type' => '0',
            'variations' => [
                ['id' => 'reg', 'name' => 'Single Herb Patty', 'price' => 0],
                ['id' => 'dbl', 'name' => 'Double Patty + Cheese Slice', 'price' => 40],
                ['id' => 'jmb', 'name' => 'Triple Loaded Jumbo Burger', 'price' => 75],
            ],
            'addons' => [
                ['id' => 'a1', 'name' => 'Extra Liquid Cheese Melt', 'price' => 30, 'is_veg' => true],
                ['id' => 'a2', 'name' => 'Jalapenos & Chipotle Dip', 'price' => 25, 'is_veg' => true],
                ['id' => 'a3', 'name' => 'French Fries (Salted)', 'price' => 49, 'is_veg' => true],
                ['id' => 'a4', 'name' => 'Add Cold Beverage (250ml)', 'price' => 35, 'is_veg' => true],
            ],
        ]);

        // Item 6: Chole Bhature (Veg)
        FoodItems::where('id', 6)->update([
            'is_veg' => true,
            'food_type' => '0',
            'variations' => [
                ['id' => 'std', 'name' => 'Standard (2 Fluffy Bhature)', 'price' => 0],
                ['id' => 'pnr', 'name' => 'Paneer Stuffed (2 Bhature)', 'price' => 50],
                ['id' => 'ext', 'name' => 'Bumper Plate (3 Bhature)', 'price' => 40],
            ],
            'addons' => [
                ['id' => 'cb1', 'name' => 'Extra Chole Bowl', 'price' => 45, 'is_veg' => true],
                ['id' => 'cb2', 'name' => 'Sweet Amritsari Lassi', 'price' => 50, 'is_veg' => true],
                ['id' => 'cb3', 'name' => 'Spicy Fried Green Chillies', 'price' => 10, 'is_veg' => true],
            ],
        ]);

        // Item 4, 8: Desserts
        FoodItems::where('id', 4)->update(['is_veg' => true, 'food_type' => '3']);
        FoodItems::where('id', 8)->update([
            'is_veg' => true,
            'food_type' => '3',
            'variations' => [
                ['id' => 'p2', 'name' => '2 Pieces (Hot Bowl)', 'price' => 0],
                ['id' => 'p4', 'name' => '4 Pieces (Family Pack)', 'price' => 60],
            ],
            'addons' => [
                ['id' => 'g1', 'name' => 'Vanilla Ice Cream Scoop', 'price' => 35, 'is_veg' => true],
            ],
        ]);

        // Items 7, 9, 10
        FoodItems::where('id', 7)->update(['is_veg' => true, 'food_type' => '2']);
        FoodItems::where('id', 9)->update(['is_veg' => true, 'food_type' => '2']);
        FoodItems::where('id', 10)->update(['is_veg' => true, 'food_type' => '0']);

        // 2. Add New Signature NON-VEG & VEG Dishes with variations and add-ons
        $newDishes = [
            [
                'category_id' => 1,
                'food_category' => 0, // Fast Food
                'food_name' => 'Crispy Chicken Burger',
                'food_subtitle' => 'Crispy fried chicken breast fillet with spicy mayo',
                'food_slug' => 'crispy-chicken-burger',
                'food_desc' => 'Tender, juicy chicken breast fillet with a crunchy golden coating, fresh crispy lettuce, and signature spicy garlic mayo in a toasted brioche bun.',
                'food_image' => 'assets/images/burger.png',
                'food_type' => '1',
                'is_veg' => false,
                'food_stock' => 25,
                'food_price' => 179.00,
                'food_old_price' => 229.00,
                'food_rating' => 4.8,
                'food_preparation_time' => '15',
                'food_is_popular' => 1,
                'food_is_featured' => 1,
                'food_status' => 1,
                'variations' => [
                    ['id' => 'reg', 'name' => 'Single Crispy Fillet', 'price' => 0],
                    ['id' => 'dbl', 'name' => 'Double Crispy Fillet + Cheese', 'price' => 60],
                ],
                'addons' => [
                    ['id' => 'chz', 'name' => 'Extra Melted Cheddar Slice', 'price' => 25, 'is_veg' => true],
                    ['id' => 'dip', 'name' => 'Tandoori Garlic Mayo Dip', 'price' => 20, 'is_veg' => true],
                    ['id' => 'frs', 'name' => 'Peri-Peri French Fries', 'price' => 55, 'is_veg' => true],
                    ['id' => 'bcn', 'name' => 'Crispy Fried Chicken Strip Add-on', 'price' => 45, 'is_veg' => false],
                ],
            ],
            [
                'category_id' => 1,
                'food_category' => 0, // Fast Food
                'food_name' => 'Spicy Glazed Chicken Wings',
                'food_subtitle' => 'Crispy wings tossed in fiery BBQ glaze & mint dip',
                'food_slug' => 'spicy-glazed-chicken-wings',
                'food_desc' => 'Succulent bone-in chicken wings flash-fried till golden and tossed in a bold, tangy chili glaze. Served piping hot with herb dip.',
                'food_image' => 'assets/images/chicken_wings_img.jfif',
                'food_type' => '1',
                'is_veg' => false,
                'food_stock' => 20,
                'food_price' => 199.00,
                'food_old_price' => 259.00,
                'food_rating' => 4.9,
                'food_preparation_time' => '18',
                'food_is_popular' => 1,
                'food_is_featured' => 1,
                'food_status' => 1,
                'variations' => [
                    ['id' => 'w4', 'name' => '4 Pieces (Snack Box)', 'price' => 0],
                    ['id' => 'w8', 'name' => '8 Pieces (Party Box)', 'price' => 120],
                ],
                'addons' => [
                    ['id' => 'd1', 'name' => 'Extra Spicy BBQ Dip', 'price' => 25, 'is_veg' => true],
                    ['id' => 'd2', 'name' => 'Creamy Garlic Mayo Dip', 'price' => 25, 'is_veg' => true],
                ],
            ],
            [
                'category_id' => 2,
                'food_category' => 1, // Desi Tadka
                'food_name' => 'Grilled Tandoori Chicken',
                'food_subtitle' => 'Clay-oven roasted chicken marinated in rich Punjabi spices',
                'food_slug' => 'grilled-tandoori-chicken',
                'food_desc' => 'Classic Indian tandoori delicacy marinated overnight in strained yogurt, crushed ginger-garlic, and tandoori spices. Smoked to perfection over charcoals.',
                'food_image' => 'assets/images/grildChicken.jfif',
                'food_type' => '1',
                'is_veg' => false,
                'food_stock' => 15,
                'food_price' => 249.00,
                'food_old_price' => 320.00,
                'food_rating' => 4.9,
                'food_preparation_time' => '25',
                'food_is_popular' => 1,
                'food_is_featured' => 1,
                'food_status' => 1,
                'variations' => [
                    ['id' => 'half', 'name' => 'Half Chicken (2 Big Pieces)', 'price' => 0],
                    ['id' => 'full', 'name' => 'Full Chicken (4 Big Pieces)', 'price' => 180],
                ],
                'addons' => [
                    ['id' => 'naan', 'name' => 'Butter Garlic Naan (2 Pcs)', 'price' => 50, 'is_veg' => true],
                    ['id' => 'rice', 'name' => 'Jeera Rice Bowl', 'price' => 55, 'is_veg' => true],
                    ['id' => 'chut', 'name' => 'Extra Mint Chutney & Salad', 'price' => 20, 'is_veg' => true],
                ],
            ],
            [
                'category_id' => 1,
                'food_category' => 0, // Fast Food
                'food_name' => 'Pepperoni & Cheese Pizza',
                'food_subtitle' => 'Stone-baked crust loaded with smoked pepperoni & cheese',
                'food_slug' => 'pepperoni-cheese-pizza',
                'food_desc' => 'Hand-tossed crust with rich San Marzano tomato sauce, generous mozzarella, and crispy smoked pepperoni slices finished with Italian oregano.',
                'food_image' => 'assets/images/Pepperoni_pizza.png',
                'food_type' => '1',
                'is_veg' => false,
                'food_stock' => 18,
                'food_price' => 269.00,
                'food_old_price' => 349.00,
                'food_rating' => 4.7,
                'food_preparation_time' => '20',
                'food_is_popular' => 1,
                'food_is_featured' => 0,
                'food_status' => 1,
                'variations' => [
                    ['id' => 'med', 'name' => 'Medium (10 inch - 6 Slices)', 'price' => 0],
                    ['id' => 'lrg', 'name' => 'Large (12 inch - 8 Slices)', 'price' => 130],
                ],
                'addons' => [
                    ['id' => 'c1', 'name' => 'Cheese Burst Stuffed Crust', 'price' => 50, 'is_veg' => true],
                    ['id' => 'c2', 'name' => 'Extra Pepperoni Slices', 'price' => 45, 'is_veg' => false],
                    ['id' => 'c3', 'name' => 'Cheesy Garlic Breadsticks (4 Pcs)', 'price' => 69, 'is_veg' => true],
                ],
            ],
            [
                'category_id' => 2,
                'food_category' => 1, // Desi Tadka
                'food_name' => 'Paneer Butter Masala',
                'food_subtitle' => 'Velvety makhani gravy with tender malai paneer cubes',
                'food_slug' => 'paneer-butter-masala',
                'food_desc' => 'Fresh cottage cheese cubes simmered in a velvety sauce of ripe tomatoes, butter, cashew paste, and aromatic spices.',
                'food_image' => 'assets/images/paneer_img.jfif',
                'food_type' => '0',
                'is_veg' => true,
                'food_stock' => 25,
                'food_price' => 189.00,
                'food_old_price' => 249.00,
                'food_rating' => 4.9,
                'food_preparation_time' => '20',
                'food_is_popular' => 1,
                'food_is_featured' => 1,
                'food_status' => 1,
                'variations' => [
                    ['id' => 'half', 'name' => 'Half Handi (Serves 1-2)', 'price' => 0],
                    ['id' => 'full', 'name' => 'Full Handi (Serves 3-4)', 'price' => 90],
                ],
                'addons' => [
                    ['id' => 'r1', 'name' => 'Butter Tandoori Roti (2 Pcs)', 'price' => 30, 'is_veg' => true],
                    ['id' => 'r2', 'name' => 'Fragrant Jeera Rice Bowl', 'price' => 55, 'is_veg' => true],
                    ['id' => 'r3', 'name' => 'Roasted Papad & Mixed Salad', 'price' => 25, 'is_veg' => true],
                ],
            ],
        ];

        if (DB::getDriverName() === 'pgsql') {
            DB::statement("SELECT setval(pg_get_serial_sequence('\"foodItems\"', 'id'), coalesce(max(id), 0) + 1, false) FROM \"foodItems\"");
        }

        foreach ($newDishes as $dish) {
            $dish['food_category'] = (bool)($dish['food_category'] ?? false);
            $dish['food_is_popular'] = (bool)($dish['food_is_popular'] ?? false);
            $dish['food_is_featured'] = (bool)($dish['food_is_featured'] ?? false);
            $dish['food_status'] = (bool)($dish['food_status'] ?? false);
            $dish['is_veg'] = (bool)($dish['is_veg'] ?? true);

            $existing = FoodItems::where('food_slug', $dish['food_slug'])->first();
            if ($existing) {
                $existing->update($dish);
            } else {
                FoodItems::create($dish);
            }
        }
    }
}
