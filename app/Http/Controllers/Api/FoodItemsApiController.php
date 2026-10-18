<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FoodItems; 
use Illuminate\Support\Facades\Log;

class FoodItemsApiController extends Controller
{
     public function foodApi(){
        try {
            $foods = FoodItems::with('category')->where('food_status', 1)->orderBy('id' , 'ASC')->get();

            return response()->json([
                'status' => true,
                'data' => $foods,
            ])->header('Cache-Control', 'public, max-age=60, stale-while-revalidate=300');
        } catch (\Throwable $e) {
            Log::error("Error in foodApi: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
}
