<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //  Fillable fields
    protected $fillable = [
        'user_id',
        'address_id',
        'order_number',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'total_amount',
        'status',
        'payment_method',
        'payment_status',
        'notes'
    ];

    // Relationship: Order belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Order belongs to Address
    public function address()
    {
        return $this->belongsTo(UserAddress::class, 'address_id');
    }

    // Relationship: Order has many OrderItems
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
