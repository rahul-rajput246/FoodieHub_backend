<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodItems;
use App\Models\FoodCategory;

class FoodItemsController extends Controller
{
    public function createFood(){
        $foods = FoodItems::orderBy('id', 'ASC')->get();
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
            $image = $request->file('food_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/images'), $imageName);
            $data['food_image'] = 'assets/images/' . $imageName;
        }

        $data['food_category'] = $request->food_category;
        $data['food_is_popular'] = $request->food_is_popular;
        $data['food_is_featured'] = $request->food_is_featured;
        $data['food_status'] = $request->food_status;

        FoodItems::create($data);

        return redirect()->route('admin.allFood')->with('success' , 'food inserted successfully');

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
        ]);

        if($request->hasFile('food_image')){
            $image = $request->file('food_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/images'), $imageName);
            $data['food_image'] = 'assets/images/' . $imageName;
        } else {
            $data['food_image'] = $food->food_image;
        }

        $data['food_category'] = $request->food_category;
        $data['food_is_popular'] = $request->food_is_popular;
        $data['food_is_featured'] = $request->food_is_featured;
        $data['food_status'] = $request->food_status;

        $food->update($data);

        return redirect()->route('admin.allFood')->with('success' , 'Update Food Successfully');
        
    }

    public function deleteFood($id){
        $food = FoodItems::findOrFail($id);

         $food->delete();

        return redirect()->route('admin.allFood')->with('success' , 'Food Deleted Successfully');

    }

}
