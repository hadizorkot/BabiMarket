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
        $validatedData = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'promotion_id' => 'required|exists:promotions,id',
        ]);

        $promotionCategory = \App\Models\PromotionCategory::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $promotionCategory,
            'message' => 'Promotion Category created successfully'
        ], 201);
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

        $validatedData = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'promotion_id' => 'required|exists:promotions,id',
        ]);

        $promotionCategory->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $promotionCategory,
            'message' => 'Promotion Category updated successfully'
        ]);
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
