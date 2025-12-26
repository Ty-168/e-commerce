<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function getCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validated);
        return response()->json($category, 201);
    }

    public function getCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return response()->json($category);
    }

    public function updateCategory(Request $request, $categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);
        return response()->json($category);
    }

    public function deleteCategory($categoryId)
    {
      $category = Category::findOrFail($categoryId);
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
