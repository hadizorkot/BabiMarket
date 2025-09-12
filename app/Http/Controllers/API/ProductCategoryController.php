<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCategories = \App\Models\ProductCategory::all();
        return response()->json([
            'success' => true,
            'data' => $productCategories,
            'message' => 'Product Categories retrieved successfully'
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'parent_category_id' => 'nullable|exists:product_categories,id',
        ]);

        $productCategory = \App\Models\ProductCategory::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $productCategory,
            'message' => 'Product Category created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $productCategory = \App\Models\ProductCategory::find($id);
        if (!$productCategory) {
            return response()->json([
                'success' => false,
                'message' => 'Product Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $productCategory,
            'message' => 'Product Category retrieved successfully'
        ]);
    }

 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $productCategory = \App\Models\ProductCategory::find($id);
        if (!$productCategory) {
            return response()->json([
                'success' => false,
                'message' => 'Product Category not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'category_name' => 'sometimes|required|string|max:255',
            'parent_category_id' => 'nullable|exists:product_categories,id',
        ]);

        $productCategory->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $productCategory,
            'message' => 'Product Category updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $productCategory = \App\Models\ProductCategory::find($id);
        if (!$productCategory) {
            return response()->json([
                'success' => false,
                'message' => 'Product Category not found'
            ], 404);
        }

        $productCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product Category deleted successfully'
        ]);
    }
}
