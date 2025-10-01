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
        // Retrieve all shop orders
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
        // Validate the input data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_date' => 'required|date',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'shipping_address_id' => 'required|exists:addresses,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'order_total' => 'required|numeric|min:0',
            'order_status_id' => 'required|exists:order_statuses,id',
        ]);

        // Check if a similar order already exists for the user with the same shipping address, shipping method, and order date
        $existingOrder = \App\Models\ShopOrder::where('user_id', $validatedData['user_id'])
                                                ->where('shipping_address_id', $validatedData['shipping_address_id'])
                                                ->where('shipping_method_id', $validatedData['shipping_method_id'])
                                                ->where('order_date', $validatedData['order_date'])
                                                ->first();

        // If a duplicate order exists, return an error message
        if ($existingOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Duplicate order found with the same user, shipping address, shipping method, and order date.'
            ], 400);
        }

        // If no duplicate is found, create the order
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
        $shopOrder = \App\Models\ShopOrder::with(['paymentMethod', 'shippingMethod', 'orderStatus'])->find($id);
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

        // Validate the input data
        $validatedData = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'order_date' => 'sometimes|date',
            'payment_method_id' => 'sometimes|required|exists:payment_methods,id',
            'shipping_address_id' => 'sometimes|required|exists:addresses,id',
            'shipping_method_id' => 'sometimes|required|exists:shipping_methods,id',
            'order_total' => 'sometimes|required|numeric|min:0',
            'order_status_id' => 'sometimes|required|exists:order_statuses,order_status_id',
        ]);

        // Update the shop order
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
