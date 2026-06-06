<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodCategory;

class FoodCategoryController extends Controller
{
    public function allCategory()
    {
        $category = FoodCategory::withCount('foods')->orderBy('id', 'ASC')->get();
        return view('admin.allCategory', compact('category'));
    }

    public function addCategory()
    {
        return view('admin.forms.createCategory');
    }

    public function updateCategory(Request $request)
    {
        $data = $request->validate([
            'category_name' => 'required|string',
            'category_slug' => 'required|string',
            'category_status' => 'required|boolean',
        ]);

        FoodCategory::create($data);

        return redirect()->route('admin.category')->with('success', 'Category Created Successfully');
    }
}