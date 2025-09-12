<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $shippingMethods = \App\Models\ShippingMethod::all();
        return response()->json([
            'success' => true,
            'data' => $shippingMethods,
            'message' => 'Shipping Methods retrieved successfully'
        ]);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:shipping_methods,name',
            'price' => 'required|numeric|min:0',
        ]);

        $shippingMethod = \App\Models\ShippingMethod::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $shippingMethod,
            'message' => 'Shipping Method created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $shippingMethod = \App\Models\ShippingMethod::find($id);
        if (!$shippingMethod) {
            return response()->json([
                'success' => false,
                'message' => 'Shipping Method not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $shippingMethod,
            'message' => 'Shipping Method retrieved successfully'
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shippingMethod = \App\Models\ShippingMethod::find($id);
        if (!$shippingMethod) {
            return response()->json([
                'success' => false,
                'message' => 'Shipping Method not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:100|unique:shipping_methods,name,' . $id,
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        $shippingMethod->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $shippingMethod,
            'message' => 'Shipping Method updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shippingMethod = \App\Models\ShippingMethod::find($id);
        if (!$shippingMethod) {
            return response()->json([
                'success' => false,
                'message' => 'Shipping Method not found'
            ], 404);
        }

        $shippingMethod->delete();

        return response()->json([
            'success' => true,
            'message' => 'Shipping Method deleted successfully'
        ]);
    }
}
