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
        // Retrieve all order lines
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
    // Validate the input data
    $validatedData = $request->validate([
        'product_item_id' => 'required|exists:product_items,id',
        'order_id' => 'required|exists:shop_orders,id',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
    ]);

    // Check if an OrderLine with the same product_item_id and order_id already exists
    $existingOrderLine = \App\Models\OrderLine::where('product_item_id', $validatedData['product_item_id'])
                                                ->where('order_id', $validatedData['order_id'])
                                                ->first();

    // If the OrderLine exists, return an error message
    if ($existingOrderLine) {
        return response()->json([
            'success' => false,
            'message' => 'This product is already in the order.'
        ], 400);
    }

    // If no duplicate order line exists, create the order line
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
        // Retrieve the order line with related `ProductItem` and `ShopOrder`
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
        // Find the order line
        $orderLine = \App\Models\OrderLine::find($id);
        if (!$orderLine) {
            return response()->json([
                'success' => false,
                'message' => 'Order Line not found'
            ], 404);
        }

        // Validate the input data
        $validatedData = $request->validate([
            'product_item_id' => 'sometimes|required|exists:product_items,id',
            'order_id' => 'sometimes|required|exists:shop_orders,id',
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        // Update the order line
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
        // Find the order line
        $orderLine = \App\Models\OrderLine::find($id);
        if (!$orderLine) {
            return response()->json([
                'success' => false,
                'message' => 'Order Line not found'
            ], 404);
        }

        // Delete the order line
        $orderLine->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order Line deleted successfully'
        ]);
    }
}
