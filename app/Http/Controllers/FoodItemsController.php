<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodItems;
use App\Models\FoodCategory;
use App\Helpers\ImageHelper;

class FoodItemsController extends Controller
{
    public function createFood(){
        $foods = FoodItems::with('category')->orderBy('id', 'ASC')->get();
        $categories = FoodCategory::where('category_status', 1)->orderBy('id', 'ASC')->get();

        return view('admin.allFood', compact('foods', 'categories'));
    }

    public function createFoodUpdate(Request $request){
        $data = $request->validate([
            'food_name' => 'required|string',
            'food_subtitle' => 'nullable|string',
            'food_slug' => 'required|string',
            'food_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'food_desc' => 'nullable|string',
            'food_type' => 'nullable|string',
            'food_stock' => 'nullable|integer',
            'food_price' => 'required|numeric',
            'food_old_price' => 'nullable|numeric',
            'food_rating' => 'nullable|numeric',
            'food_preparation_time' => 'nullable|string|max:100',
            'category_id' => 'nullable|exists:food_Category,id',
        ]);

        if($request->hasFile('food_image')){
            $data['food_image'] = ImageHelper::processUploadedImage($request->file('food_image'), 'assets/images', 800, 75);
        }

        $data['category_id'] = $request->filled('category_id') ? $request->category_id : null;
        $data['food_category'] = (bool)($request->food_category ?? false);
        $data['food_is_popular'] = $request->has('food_is_popular') && $request->food_is_popular !== '' ? (bool)(int)$request->food_is_popular : false;
        $data['food_is_featured'] = $request->has('food_is_featured') && $request->food_is_featured !== '' ? (bool)(int)$request->food_is_featured : false;
        $data['food_status'] = $request->has('food_status') && $request->food_status !== '' ? (bool)(int)$request->food_status : true;
        $data['is_veg'] = ($request->food_type === '1' || strtolower((string)$request->food_type) === 'non_veg') ? false : true;
        $data['food_rating'] = $request->filled('food_rating') ? (float)$request->food_rating : 4.5;

        FoodItems::create($data);

        return redirect()->route('admin.allFood')->with('success' , 'Food item created successfully');

    }

    public function editFood($id)
    {
        $food = FoodItems::findOrFail($id);
        $categories = FoodCategory::where('category_status', 1)
            ->orderBy('id', 'ASC')
            ->get();

        return view('admin.forms.editFood', compact('food', 'categories'));
    }

    public function createFoodForm()
    {
        $categories = FoodCategory::where('category_status', 1)->orderBy('id', 'ASC')->get();
        return view('admin.forms.createFood', compact('categories'));
    }

    public function updateFood(Request $request , $id){
        $food = FoodItems::findOrFail($id);

         $data = $request->validate([
            'food_name' => 'required|string',
            'food_subtitle' => 'nullable|string',
            'food_slug' => 'required|string',
            'food_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'food_desc' => 'nullable|string',
            'food_type' => 'nullable|string',
            'food_stock' => 'nullable|integer',
            'food_price' => 'required|numeric',
            'food_old_price' => 'nullable|numeric',
            'food_rating' => 'nullable|numeric',
            'food_preparation_time' => 'nullable|string|max:100',
            'category_id' => 'nullable|exists:food_Category,id',
        ]);

        if($request->hasFile('food_image')){
            $data['food_image'] = ImageHelper::processUploadedImage($request->file('food_image'), 'assets/images', 800, 75);
        } else {
            $data['food_image'] = $food->food_image;
        }

        $data['category_id'] = $request->filled('category_id') ? $request->category_id : null;
        $data['food_category'] = (bool)($request->food_category ?? $food->food_category ?? false);
        $data['food_is_popular'] = $request->has('food_is_popular') && $request->food_is_popular !== '' ? (bool)(int)$request->food_is_popular : (bool)$food->food_is_popular;
        $data['food_is_featured'] = $request->has('food_is_featured') && $request->food_is_featured !== '' ? (bool)(int)$request->food_is_featured : (bool)$food->food_is_featured;
        $data['food_status'] = $request->has('food_status') && $request->food_status !== '' ? (bool)(int)$request->food_status : (bool)$food->food_status;
        $data['is_veg'] = ($request->food_type === '1' || strtolower((string)$request->food_type) === 'non_veg') ? false : true;
        $data['food_rating'] = $request->filled('food_rating') ? (float)$request->food_rating : ($food->food_rating ?? 4.5);

        $food->update($data);

        return redirect()->route('admin.allFood')->with('success' , 'Food item updated successfully');
        
    }

    public function deleteFood($id){
        $food = FoodItems::findOrFail($id);

        $food->delete();

        return redirect()->route('admin.allFood')->with('success' , 'Food Deleted Successfully');

    }

}
