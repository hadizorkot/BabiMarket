<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $shopOrders = \App\Models\ShopOrder::all();
        return response()->json([
            'success' => true,
            'data' => $shopOrders,
            'message' => 'Shop Orders retrieved successfully'
        ]);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_date' => 'required|date',
            'payment_method_id' => 'required|exists:payment_types,id',
            'shipping_address_id' => 'required|exists:addresses,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'order_total' => 'required|numeric|min:0',
            'order_status' => 'required|exists:order_statuses,order_status',
        ]);

        $shopOrder = \App\Models\ShopOrder::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $shopOrder,
            'message' => 'Shop Order created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $shopOrder = \App\Models\ShopOrder::find($id);
        if (!$shopOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Shop Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $shopOrder,
            'message' => 'Shop Order retrieved successfully'
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shopOrder = \App\Models\ShopOrder::find($id);
        if (!$shopOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Shop Order not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'order_date' => 'sometimes|date',
            'payment_method_id' => 'sometimes|exists:payment_types,id',
            'shipping_address_id' => 'sometimes|exists:addresses,id',
            'shipping_method_id' => 'sometimes|exists:shipping_methods,id',
            'order_total' => 'sometimes|numeric|min:0',
            'order_status' => 'sometimes|exists:order_statuses,order_status',
        ]);

        $shopOrder->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $shopOrder,
            'message' => 'Shop Order updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shopOrder = \App\Models\ShopOrder::find($id);
        if (!$shopOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Shop Order not found'
            ], 404);
        }

        $shopOrder->delete();

        return response()->json([
            'success' => true,
            'message' => 'Shop Order deleted successfully'
        ]);
    }
}
