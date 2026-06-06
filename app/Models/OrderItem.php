<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
     // Fillable fields
    protected $fillable = [
        'order_id',
        'food_item_id',
        'food_name',
        'price',
        'quantity',
        'subtotal'
    ];

    // Relationship: Item belongs to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship: Item belongs to FoodItem
    public function food()
    {
        return $this->belongsTo(FoodItems::class, 'food_item_id');
    }
}
