<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',
        'food_item_id',
        'quantity',
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
