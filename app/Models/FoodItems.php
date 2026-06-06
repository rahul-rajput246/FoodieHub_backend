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
        'food_stock',
        'food_price',
        'food_old_price',
        'food_rating',
        'food_preparation_time',
        'food_is_popular',
        'food_is_featured',
        'food_status',
        'category_id',
    ];

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

    protected $appends = ['category_name', 'image_url'];

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
