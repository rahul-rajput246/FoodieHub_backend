<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FoodItems;

class FoodCategory extends Model
{
    protected $table = 'food_Category';

    protected $fillable = [
        'category_name',
        'category_slug',
        'category_status',
    ];

     public function foods()
    {
        return $this->hasMany(FoodItems::class, 'category_id');
    }

}
