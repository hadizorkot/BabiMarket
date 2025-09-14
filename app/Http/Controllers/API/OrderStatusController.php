<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all order statuses
        $orderStatuses = \App\Models\OrderStatus::all();
        return response()->json([
            'success' => true,
            'data' => $orderStatuses,
            'message' => 'Order Statuses retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'order_status' => 'required|string|max:100|unique:order_statuses,order_status',
        ]);

        // Create the order status
        $orderStatus = \App\Models\OrderStatus::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $orderStatus,
            'message' => 'Order Status created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orderStatus = \App\Models\OrderStatus::find($id);
        if (!$orderStatus) {
            return response()->json([
                'success' => false,
                'message' => 'Order Status not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $orderStatus,
            'message' => 'Order Status retrieved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $orderStatus = \App\Models\OrderStatus::find($id);
        if (!$orderStatus) {
            return response()->json([
                'success' => false,
                'message' => 'Order Status not found'
            ], 404);
        }

        // Validate the request data
        $validatedData = $request->validate([
            'order_status' => 'required|string|max:100|unique:order_statuses,order_status,' . $id,
        ]);

        // Update the order status
        $orderStatus->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $orderStatus,
            'message' => 'Order Status updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderStatus = \App\Models\OrderStatus::find($id);
        if (!$orderStatus) {
            return response()->json([
                'success' => false,
                'message' => 'Order Status not found'
            ], 404);
        }

        
        $orderStatus->shopOrders()->update(['order_status' => null]);

        $orderStatus->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order Status deleted successfully'
        ]);
    }
}
