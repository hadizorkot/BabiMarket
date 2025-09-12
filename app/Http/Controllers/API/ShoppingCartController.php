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
        
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $shoppingCart = \App\Models\ShoppingCart::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $shoppingCart,
            'message' => 'Shopping Cart created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $shoppingCart = \App\Models\ShoppingCart::find($id);
        if (!$shoppingCart) {
            return response()->json([
                'success' => false,
                'message' => 'Shopping Cart not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $shoppingCart,
            'message' => 'Shopping Cart retrieved successfully'
        ]);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shoppingCart = \App\Models\ShoppingCart::find($id);
        if (!$shoppingCart) {
            return response()->json([
                'success' => false,
                'message' => 'Shopping Cart not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $shoppingCart->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $shoppingCart,
            'message' => 'Shopping Cart updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shoppingCart = \App\Models\ShoppingCart::find($id);
        if (!$shoppingCart) {
            return response()->json([
                'success' => false,
                'message' => 'Shopping Cart not found'
            ], 404);
        }

        $shoppingCart->delete();

        return response()->json([
            'success' => true,
            'message' => 'Shopping Cart deleted successfully'
        ]);
    }
}
