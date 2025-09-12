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
        $validatedData = $request->validate([
            'order_status' => 'required|string|max:100|unique:order_statuses,order_status',
        ]);

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

        $validatedData = $request->validate([
            'order_status' => 'required|string|max:100|unique:order_statuses,order_status,' . $id,
        ]);

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

        $orderStatus->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order Status deleted successfully'
        ]);
    }
}
