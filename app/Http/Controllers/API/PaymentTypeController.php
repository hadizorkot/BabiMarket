<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all payment types
        $paymentTypes = \App\Models\PaymentType::all();
        return response()->json([
            'success' => true,
            'data' => $paymentTypes,
            'message' => 'Payment Types retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'value' => 'required|string|max:100|unique:payment_types,value',  // Ensures value is unique
        ]);

        // Create payment type
        $paymentType = \App\Models\PaymentType::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $paymentType,
            'message' => 'Payment Type created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find payment type by ID
        $paymentType = \App\Models\PaymentType::find($id);
        if (!$paymentType) {
            return response()->json([
                'success' => false,
                'message' => 'Payment Type not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $paymentType,
            'message' => 'Payment Type retrieved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find payment type by ID
        $paymentType = \App\Models\PaymentType::find($id);
        if (!$paymentType) {
            return response()->json([
                'success' => false,
                'message' => 'Payment Type not found'
            ], 404);
        }

        // Validate the input data
        $validatedData = $request->validate([
            'value' => 'required|string|max:100|unique:payment_types,value,' . $id,  // Ensures uniqueness excluding the current record
        ]);

        // Update the payment type
        $paymentType->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $paymentType,
            'message' => 'Payment Type updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find payment type by ID
        $paymentType = \App\Models\PaymentType::find($id);
        if (!$paymentType) {
            return response()->json([
                'success' => false,
                'message' => 'Payment Type not found'
            ], 404);
        }

        // Delete payment type
        $paymentType->delete();

        return response()->json([
            'success' => true,
            'message' => 'Payment Type deleted successfully'
        ]);
    }
}
