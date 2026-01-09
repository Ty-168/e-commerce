<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
	public function getProducts()
	{
		$products = Product::all();
		return response()->json($products);
	}

	public function createProduct(Request $request)
	{
		Gate::authorize('products.create');
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'description' => 'nullable|string',
			'category_id' => 'required|exists:categories,id',
			// accept either 'pricing' or 'price'
			'pricing' => 'nullable|numeric',
			'images' => 'nullable|array',
			'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
		]);

		$data = [
			'name' => $validated['name'],
			'description' => $validated['description'] ?? null,
			'category_id' => $validated['category_id'],
			'pricing' => $validated['pricing'] ?? $validated['price'] ?? null,
		];

		$imagePaths = [];
		if ($request->hasFile('images')) {
			foreach ($request->file('images') as $file) {
				$path = $file->store('products', 'public');
				$imagePaths[] = Storage::url($path);
			}
			$data['images'] = $imagePaths;
		}

		$product = Product::create($data);
		return response()->json($product, 201);
	}

	public function getProduct($productId)
	{
		$product = Product::findOrFail($productId);
		return response()->json($product);
	}

	public function updateProduct(Request $request, $productId)
	{
		Gate::authorize('products.update');
		$product = Product::findOrFail($productId);

		$validated = $request->validate([
			'name' => 'sometimes|required|string|max:255',
			'description' => 'nullable|string',
		]);

		$product->update($validated);
		return response()->json($product);
	}

	public function deleteProduct($productId)
	{
		Gate::authorize('products.delete');
		$product = Product::findOrFail($productId);
		$product->delete();
		return response()->json(['message' => 'Product deleted successfully'], 200);
	}
}
