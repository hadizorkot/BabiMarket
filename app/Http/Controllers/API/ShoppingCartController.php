<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all shopping carts
        $shoppingCarts = \App\Models\ShoppingCart::all();
        return response()->json([
            'success' => true,
            'data' => $shoppingCarts,
            'message' => 'Shopping Carts retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',  // Ensure the user exists
        ]);

        // Check if the user already has a shopping cart
        $existingCart = \App\Models\ShoppingCart::where('user_id', $request->user_id)->first();
        if ($existingCart) {
            return response()->json([
                'success' => false,
                'message' => 'User already has a shopping cart'
            ], 400);
        }

        // Create a new shopping cart
        try {
            $shoppingCart = \App\Models\ShoppingCart::create($validatedData);
            return response()->json([
                'success' => true,
                'data' => $shoppingCart,
                'message' => 'Shopping Cart created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating Shopping Cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the shopping cart by ID
        $shoppingCart = \App\Models\ShoppingCart::find($id);
        if (!$shoppingCart) {
            return response()->json([
                'success' => false,
                'message' => 'Shopping Cart not found'
            ], 404);
        }

        // Retrieve cart items if they exist
        $cartItems = $shoppingCart->items;
        return response()->json([
            'success' => true,
            'data' => [
                'shopping_cart' => $shoppingCart,
                'items' => $cartItems
            ],
            'message' => 'Shopping Cart retrieved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the shopping cart by ID
        $shoppingCart = \App\Models\ShoppingCart::find($id);
        if (!$shoppingCart) {
            return response()->json([
                'success' => false,
                'message' => 'Shopping Cart not found'
            ], 404);
        }

        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        // Update the shopping cart
        try {
            $shoppingCart->update($validatedData);
            return response()->json([
                'success' => true,
                'data' => $shoppingCart,
                'message' => 'Shopping Cart updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating Shopping Cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the shopping cart by ID
        $shoppingCart = \App\Models\ShoppingCart::find($id);
        if (!$shoppingCart) {
            return response()->json([
                'success' => false,
                'message' => 'Shopping Cart not found'
            ], 404);
        }

        // Delete the shopping cart
        try {
            $shoppingCart->delete();
            return response()->json([
                'success' => true,
                'message' => 'Shopping Cart deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting Shopping Cart: ' . $e->getMessage()
            ], 500);
        }
    }
}

