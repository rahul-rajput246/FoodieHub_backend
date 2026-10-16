<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'WELCOME50',
                'description' => 'Flat ₹50 OFF on your first delicious order',
                'discount_type' => 'fixed',
                'discount_value' => 50,
                'min_order_amount' => 199,
                'max_discount_amount' => null,
                'usage_limit' => 500,
                'used_count' => 0,
                'user_limit' => 1,
                'valid_from' => Carbon::now()->subDays(1),
                'valid_until' => Carbon::now()->addMonths(6),
                'is_active' => true,
            ],
            [
                'code' => 'FOODIE100',
                'description' => 'Save ₹100 instantly on orders above ₹499',
                'discount_type' => 'fixed',
                'discount_value' => 100,
                'min_order_amount' => 499,
                'max_discount_amount' => null,
                'usage_limit' => 1000,
                'used_count' => 0,
                'user_limit' => 3,
                'valid_from' => Carbon::now()->subDays(1),
                'valid_until' => Carbon::now()->addMonths(6),
                'is_active' => true,
            ],
            [
                'code' => 'TASTY20',
                'description' => 'Get 20% OFF up to ₹150 on orders above ₹299',
                'discount_type' => 'percentage',
                'discount_value' => 20,
                'min_order_amount' => 299,
                'max_discount_amount' => 150,
                'usage_limit' => 1000,
                'used_count' => 0,
                'user_limit' => 5,
                'valid_from' => Carbon::now()->subDays(1),
                'valid_until' => Carbon::now()->addMonths(6),
                'is_active' => true,
            ],
            [
                'code' => 'FESTIVE200',
                'description' => 'Huge savings! Flat ₹200 OFF on feast orders above ₹799',
                'discount_type' => 'fixed',
                'discount_value' => 200,
                'min_order_amount' => 799,
                'max_discount_amount' => null,
                'usage_limit' => 300,
                'used_count' => 0,
                'user_limit' => 2,
                'valid_from' => Carbon::now()->subDays(1),
                'valid_until' => Carbon::now()->addMonths(3),
                'is_active' => true,
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::updateOrCreate(
                ['code' => $coupon['code']],
                $coupon
            );
        }
    }
}
