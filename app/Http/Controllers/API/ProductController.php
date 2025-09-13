<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $products = \App\Models\Product::all();
        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => 'Products retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the input data
    $validatedData = $request->validate([
        'category_id' => 'required|exists:product_categories,id', // Ensure category exists
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'product_image' => 'nullable|url', // Ensure product_image is a valid URL or null
    ]);

    // Check if a product with the same category_id, name, and description already exists
    $existingProduct = \App\Models\Product::where('category_id', $request->category_id)
                                          ->where('name', $request->name)
                                          ->where('description', $request->description)
                                          ->first();

    // If a product with the same category_id, name, and description exists, return an error
    if ($existingProduct) {
        return response()->json([
            'success' => false,
            'message' => 'A product with this name and description already exists in this category.'
        ], 400);
    }

    // If no duplicate exists, create the product
    try {
        $product = \App\Models\Product::create($validatedData);
        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Product created successfully'
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error creating Product: ' . $e->getMessage()
        ], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = \App\Models\Product::find($id);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Product retrieved successfully'
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Find the product
    $product = \App\Models\Product::find($id);
    if (!$product) {
        return response()->json([
            'success' => false,
            'message' => 'Product not found'
        ], 404);
    }

    // Validate the input data
    $validatedData = $request->validate([
        'category_id' => 'required|exists:product_categories,id', // Ensure category exists
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'product_image' => 'nullable|url', // Ensure product_image is a valid URL or null
    ]);

    // Check if another product with the same category_id, name, and description exists (excluding the current product)
    $existingProduct = \App\Models\Product::where('category_id', $request->category_id)
                                          ->where('name', $request->name)
                                          ->where('description', $request->description)
                                          ->where('id', '!=', $id) // Exclude current product
                                          ->first();

    // If a product with the same category_id, name, and description exists, return an error
    if ($existingProduct) {
        return response()->json([
            'success' => false,
            'message' => 'A product with this name and description already exists in this category.'
        ], 400);
    }

    // If no duplicate exists, update the product
    try {
        $product->update($validatedData);
        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Product updated successfully'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error updating Product: ' . $e->getMessage()
        ], 500);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = \App\Models\Product::find($id);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}
