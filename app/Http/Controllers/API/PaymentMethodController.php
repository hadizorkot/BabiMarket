<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $paymentMethods = \App\Models\PaymentMethod::all();
        return response()->json([
            'success' => true,
            'data' => $paymentMethods,
            'message' => 'Payment Methods retrieved successfully'
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'payment_type_id' => 'required|exists:payment_types,id',
            'provider' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'expiry_date' => 'nullable|date_format:Y-m-d',
            'is_default' => 'boolean',
        ]);

        $paymentMethod = \App\Models\PaymentMethod::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $paymentMethod,
            'message' => 'Payment Method created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paymentMethod = \App\Models\PaymentMethod::find($id);
        if (!$paymentMethod) {
            return response()->json([
                'success' => false,
                'message' => 'Payment Method not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $paymentMethod,
            'message' => 'Payment Method retrieved successfully'
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $paymentMethod = \App\Models\PaymentMethod::find($id);
        if (!$paymentMethod) {
            return response()->json([
                'success' => false,
                'message' => 'Payment Method not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'payment_type_id' => 'sometimes|required|exists:payment_types,id',
            'provider' => 'sometimes|required|string|max:100',
            'account_number' => 'sometimes|required|string|max:50',
            'expiry_date' => 'nullable|date_format:Y-m-d',
            'is_default' => 'boolean',
        ]);

        $paymentMethod->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $paymentMethod,
            'message' => 'Payment Method updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymentMethod = \App\Models\PaymentMethod::find($id);
        if (!$paymentMethod) {
            return response()->json([
                'success' => false,
                'message' => 'Payment Method not found'
            ], 404);
        }

        $paymentMethod->delete();

        return response()->json([
            'success' => true,
            'message' => 'Payment Method deleted successfully'
        ]);
    }
}
