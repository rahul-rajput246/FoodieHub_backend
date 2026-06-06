<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FoodItems; 

class FoodItemsApiController extends Controller
{
     public function foodApi(){
        $foods = FoodItems::where('food_status', 1)->orderBy('id' , 'ASC')->get();

        return response()->json([
            'status' => true,
            'data' => $foods,
        ]);
    }
}
