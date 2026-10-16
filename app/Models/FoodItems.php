<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FoodCategory;

class FoodItems extends Model
{
    protected $table = 'foodItems';

    protected $fillable = [
        'food_name',
        'food_subtitle',
        'food_slug',
        'food_desc',
        'food_image',
        'food_category',
        'food_type',
        'is_veg',
        'food_stock',
        'food_price',
        'food_old_price',
        'variations',
        'addons',
        'food_rating',
        'food_preparation_time',
        'food_is_popular',
        'food_is_featured',
        'food_status',
        'category_id',
    ];

    protected $casts = [
        'is_veg' => 'boolean',
        'variations' => 'array',
        'addons' => 'array',
        'food_price' => 'float',
        'food_old_price' => 'float',
        'food_rating' => 'float',
        'food_is_popular' => 'boolean',
        'food_is_featured' => 'boolean',
        'food_status' => 'boolean',
    ];

    protected $appends = ['category_name', 'image_url', 'dietary_type', 'has_customizations'];

    public function getDietaryTypeAttribute()
    {
        // 1 or 'non_veg' or is_veg === false indicates Non-Veg
        if ($this->is_veg === false) {
            return 'non_veg';
        }
        $rawType = (string) $this->food_type;
        if ($rawType === '1' || strtolower($rawType) === 'non_veg') {
            return 'non_veg';
        }
        return 'veg';
    }

    public function getHasCustomizationsAttribute()
    {
        $hasVars = !empty($this->variations) && is_array($this->variations) && count($this->variations) > 0;
        $hasAdds = !empty($this->addons) && is_array($this->addons) && count($this->addons) > 0;
        return $hasVars || $hasAdds;
    }

    public function getCategoryNameAttribute()
    {
        $categories = [
            0 => 'Fast Food',
            1 => 'Desi Tadka',
            2 => 'Chill Drinks',
            3 => 'Sweet Cravings',
        ];

        return $categories[$this->food_category] ?? 'Unknown';
    }

    public function getImageUrlAttribute()
    {
        return $this->food_image ? asset($this->food_image) : null;
    }

    public function category()
    {
        return $this->belongsTo(FoodCategory::class, 'category_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'food_item_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'food_item_id');
    }

    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class, 'food_item_id');
    }


}
