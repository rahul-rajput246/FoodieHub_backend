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
        'subtotal',
        'selected_variation',
        'selected_addons',
        'customization_summary',
    ];

    protected $casts = [
        'selected_variation' => 'array',
        'selected_addons' => 'array',
        'price' => 'float',
        'subtotal' => 'float',
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
