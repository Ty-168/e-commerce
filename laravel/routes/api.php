<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = $request->user();
    // This creates the token string
    $token = $user->createToken('MobileApp')->accessToken;

    return response()->json(['token' => $token, 'user' => $user]);
});

Route::middleware('auth:api')->group(function () {
    
    // Test route to see who is logged in
    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    // Your RBAC protected controllers (from Part 3 & 4)
    Route::get('/products', [ProductController::class, 'getProducts']);
    Route::post('/products', [ProductController::class, 'createProduct']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/', 'getCategories');
    Route::post('/', 'createCategory');
    Route::get('/{categoryId}', 'getCategory');
    Route::patch('/{categoryId}', 'updateCategory');
    Route::delete('/{categoryId}', 'deleteCategory');
});

Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('/', 'getProducts');
    Route::post('/', 'createProduct');
    Route::get('/{productId}', 'getProduct');
    Route::patch('/{productId}', 'updateProduct');
    Route::delete('/{productId}', 'deleteProduct');
});
