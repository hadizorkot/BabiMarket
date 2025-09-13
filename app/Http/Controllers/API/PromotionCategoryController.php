<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromotionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $promotionCategories = \App\Models\PromotionCategory::all();
        return response()->json([
            'success' => true,
            'data' => $promotionCategories,
            'message' => 'Promotion Categories retrieved successfully'
        ]);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the request data directly inside the store method
    $request->validate([
        'category_id' => 'required|exists:product_categories,id',
        'promotion_id' => 'required|exists:promotions,id',
    ]);

    // Check if the combination already exists in the promotion_categories table
    $existingPromotionCategory = \App\Models\PromotionCategory::where('promotion_id', $request->promotion_id)
                                                              ->where('category_id', $request->category_id)
                                                              ->first();

    // If the combination exists, return an error
    if ($existingPromotionCategory) {
        return response()->json([
            'success' => false,
            'message' => 'This Promotion Category combination already exists.'
        ], 400);
    }

    // If the combination doesn't exist, create a new PromotionCategory
    try {
        $promotionCategory = \App\Models\PromotionCategory::create([
            'category_id' => $request->category_id,
            'promotion_id' => $request->promotion_id,
        ]);

        return response()->json([
            'success' => true,
            'data' => $promotionCategory,
            'message' => 'Promotion Category created successfully'
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error creating Promotion Category: ' . $e->getMessage()
        ], 500);
    }
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $promotionCategory = \App\Models\PromotionCategory::find($id);
        if (!$promotionCategory) {
            return response()->json([
                'success' => false,
                'message' => 'Promotion Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $promotionCategory,
            'message' => 'Promotion Category retrieved successfully'
        ]);

    }

    

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    $promotionCategory = \App\Models\PromotionCategory::find($id);
    if (!$promotionCategory) {
        return response()->json([
            'success' => false,
            'message' => 'Promotion Category not found'
        ], 404);
    }

    // Validate the request data directly inside the update method
    $request->validate([
        'category_id' => 'required|exists:product_categories,id',
        'promotion_id' => 'required|exists:promotions,id',
    ]);

    // Check if the combination already exists for any other PromotionCategory (except the current one being updated)
    $existingPromotionCategory = \App\Models\PromotionCategory::where('promotion_id', $request->promotion_id)
                                                              ->where('category_id', $request->category_id)
                                                              ->where('id', '!=', $id)  // Exclude the current record
                                                              ->first();

    // If the combination exists, return an error
    if ($existingPromotionCategory) {
        return response()->json([
            'success' => false,
            'message' => 'This Promotion Category combination already exists.'
        ], 400);
    }

    // If the combination doesn't exist, update the PromotionCategory
    try {
        $promotionCategory->update([
            'category_id' => $request->category_id,
            'promotion_id' => $request->promotion_id,
        ]);

        return response()->json([
            'success' => true,
            'data' => $promotionCategory,
            'message' => 'Promotion Category updated successfully'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error updating Promotion Category: ' . $e->getMessage()
        ], 500);
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $promotionCategory = \App\Models\PromotionCategory::find($id);
        if (!$promotionCategory) {
            return response()->json([
                'success' => false,
                'message' => 'Promotion Category not found'
            ], 404);
        }

        $promotionCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Promotion Category deleted successfully'
        ]);
    }
}
