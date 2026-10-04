<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeEdit;
use Illuminate\Support\Facades\Log;

class HomeApiController extends Controller
{
    public function homeApi($page){
        try {
            $home = HomeEdit::where('pages',$page)->first();
            return response()->json([
                'status' => true,
                'data' => $home
            ]);
        } catch (\Throwable $e) {
            Log::error("Error in homeApi: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
