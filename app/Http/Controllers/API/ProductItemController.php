<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $productItems = \App\Models\ProductItem::all();
        return response()->json([
            'success' => true,
            'data' => $productItems,
            'message' => 'Product Items retrieved successfully'
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'sku' => 'required|string|max:100|unique:product_items,sku',
            'product_id' => 'required|exists:products,id',
            'qty_in_stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'product_image' => 'nullable|url',
        ]);

        $productItem = \App\Models\ProductItem::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $productItem,
            'message' => 'Product Item created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productItem = \App\Models\ProductItem::find($id);
        if (!$productItem) {
            return response()->json([
                'success' => false,
                'message' => 'Product Item not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $productItem,
            'message' => 'Product Item retrieved successfully'
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $productItem = \App\Models\ProductItem::find($id);
        if (!$productItem) {
            return response()->json([
                'success' => false,
                'message' => 'Product Item not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'product_id' => 'sometimes|required|exists:products,id',
            'sku' => 'sometimes|required|string|max:100|unique:product_items,sku,' . $id,
            'price' => 'sometimes|required|numeric|min:0',
            'stock_quantity' => 'sometimes|required|integer|min:0',
        ]);

        $productItem->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $productItem,
            'message' => 'Product Item updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productItem = \App\Models\ProductItem::find($id);
        if (!$productItem) {
            return response()->json([
                'success' => false,
                'message' => 'Product Item not found'
            ], 404);
        }

        $productItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product Item deleted successfully'
        ]);
    }
}