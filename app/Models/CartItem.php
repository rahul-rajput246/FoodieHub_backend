<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',
        'food_item_id',
        'cart_key',
        'quantity',
        'selected_variation',
        'selected_addons',
        'item_price',
    ];

    protected $casts = [
        'selected_variation' => 'array',
        'selected_addons' => 'array',
        'item_price' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function food()
    {
        return $this->belongsTo(FoodItems::class, 'food_item_id');
    }
}
