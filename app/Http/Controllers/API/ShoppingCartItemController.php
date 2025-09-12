<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShoppingCartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shoppingCartItems = \App\Models\ShoppingCartItem::all();
        return response()->json([
            'success' => true,
            'data' => $shoppingCartItems,
            'message' => 'Shopping Cart Items retrieved successfully'
        ]);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'shopping_cart_id' => 'required|exists:shopping_carts,id',
            'product_item_id' => 'required|exists:product_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $shoppingCartItem = \App\Models\ShoppingCartItem::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $shoppingCartItem,
            'message' => 'Shopping Cart Item created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $shoppingCartItem = \App\Models\ShoppingCartItem::with(['shoppingCart', 'productItem'])->find($id);
        if (!$shoppingCartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Shopping Cart Item not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $shoppingCartItem,
            'message' => 'Shopping Cart Item retrieved successfully'
        ]);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shoppingCartItem = \App\Models\ShoppingCartItem::find($id);
        if (!$shoppingCartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Shopping Cart Item not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'shopping_cart_id' => 'sometimes|exists:shopping_carts,id',
            'product_item_id' => 'sometimes|exists:product_items,id',
            'quantity' => 'sometimes|integer|min:1',
        ]);

        $shoppingCartItem->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $shoppingCartItem,
            'message' => 'Shopping Cart Item updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shoppingCartItem = \App\Models\ShoppingCartItem::find($id);
        if (!$shoppingCartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Shopping Cart Item not found'
            ], 404);
        }

        $shoppingCartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Shopping Cart Item deleted successfully'
        ]);
    }
}
