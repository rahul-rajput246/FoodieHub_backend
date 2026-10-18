<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodCategory;

use App\Models\FoodItems;

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
            'category_name' => 'required|string|max:255',
            'category_slug' => 'required|string|max:255',
            'category_status' => 'required|boolean',
        ]);

        FoodCategory::create($data);

        return redirect()->route('admin.category')->with('success', 'Category Created Successfully');
    }

    public function editCategory($id)
    {
        $category = FoodCategory::findOrFail($id);
        return view('admin.forms.editCategory', compact('category'));
    }

    public function postEditCategory(Request $request, $id)
    {
        $category = FoodCategory::findOrFail($id);
        $data = $request->validate([
            'category_name' => 'required|string|max:255',
            'category_slug' => 'required|string|max:255',
            'category_status' => 'required|boolean',
        ]);

        $category->update($data);

        return redirect()->route('admin.category')->with('success', 'Category Updated Successfully');
    }

    public function deleteCategory($id)
    {
        $category = FoodCategory::findOrFail($id);
        FoodItems::where('category_id', $id)->update(['category_id' => null]);
        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Category Deleted Successfully');
    }
}