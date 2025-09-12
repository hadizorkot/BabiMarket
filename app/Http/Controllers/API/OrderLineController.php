<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $orderLines = \App\Models\OrderLine::all();
        return response()->json([
            'success' => true,
            'data' => $orderLines,
            'message' => 'Order Lines retrieved successfully'
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_item_id' => 'required|exists:product_items,id',
            'order_id' => 'required|exists:shop_orders,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $orderLine = \App\Models\OrderLine::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $orderLine,
            'message' => 'Order Line created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orderLine = \App\Models\OrderLine::with(['productItem', 'shopOrder'])->find($id);
        if (!$orderLine) {
            return response()->json([
                'success' => false,
                'message' => 'Order Line not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $orderLine,
            'message' => 'Order Line retrieved successfully'
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $orderLine = \App\Models\OrderLine::find($id);
        if (!$orderLine) {
            return response()->json([
                'success' => false,
                'message' => 'Order Line not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'product_item_id' => 'sometimes|required|exists:product_items,id',
            'order_id' => 'sometimes|required|exists:shop_orders,id',
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        $orderLine->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $orderLine,
            'message' => 'Order Line updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderLine = \App\Models\OrderLine::find($id);
        if (!$orderLine) {
            return response()->json([
                'success' => false,
                'message' => 'Order Line not found'
            ], 404);
        }

        $orderLine->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order Line deleted successfully'
        ]);
    }
}
