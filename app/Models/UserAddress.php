<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'mobile',
        'alternate_mobile',
        'address_line',
        'city',
        'state',
        'pincode',
        'landmark',
        'type',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'address_id');
    }
}
