<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeEdit;

class HomeApiController extends Controller
{
    public function homeApi($page){
        $home = HomeEdit::where('pages',$page)->first();
        return response()->json([
            'status' => true,
            'data' => $home
        ]);
    }
}
