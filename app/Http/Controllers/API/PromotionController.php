<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $promotions = \App\Models\Promotion::all();
        return response()->json([
            'success' => true,
            'data' => $promotions,
            'message' => 'Promotions retrieved successfully'
        ]);
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'discount_rate' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $promotion = \App\Models\Promotion::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $promotion,
            'message' => 'Promotion created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $promotion = \App\Models\Promotion::find($id);
        if (!$promotion) {
            return response()->json([
                'success' => false,
                'message' => 'Promotion not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $promotion,
            'message' => 'Promotion retrieved successfully'
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $promotion = \App\Models\Promotion::find($id);
        if (!$promotion) {
            return response()->json([
                'success' => false,
                'message' => 'Promotion not found'
            ], 404);
        }

        $validatedData = $request->validate([
    'name' => 'required|string|max:255',
    'description' => 'nullable|string|max:255',  // Ensure description is optional
    'discount_rate' => 'required|numeric|min:0|max:100',
    'start_date' => 'required|date',
    'end_date' => 'required|date|after_or_equal:start_date'
]);


        $promotion->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $promotion,
            'message' => 'Promotion updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $promotion = \App\Models\Promotion::find($id);
        if (!$promotion) {
            return response()->json([
                'success' => false,
                'message' => 'Promotion not found'
            ], 404);
        }

        $promotion->delete();

        return response()->json([
            'success' => true,
            'message' => 'Promotion deleted successfully'
        ]);
    }
}
