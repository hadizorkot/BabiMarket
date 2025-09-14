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
        // Validate the input data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'payment_type_id' => 'required|exists:payment_types,id',
            'provider' => 'required|string|max:100',
            'account_number' => 'required|string|max:50|unique:payment_methods,account_number,NULL,id,user_id,' . $request->user_id, // Ensure account_number is unique per user
            'expiry_date' => 'required|date_format:Y-m-d',
            'is_default' => 'boolean',
        ]);

        // If 'is_default' is true, make sure no other payment method is set as default for the same user
        if ($validatedData['is_default'] == true) {
            \App\Models\PaymentMethod::where('user_id', $validatedData['user_id'])
                                    ->update(['is_default' => false]); // Set all other payment methods to not default
        }

        // Create the payment method
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

        // Validate the input data
        $validatedData = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'payment_type_id' => 'sometimes|required|exists:payment_types,id',
            'provider' => 'sometimes|required|string|max:100',
            'account_number' => 'sometimes|required|string|max:50|unique:payment_methods,account_number,' . $id . ',id,user_id,' . $paymentMethod->user_id, // Ensure account_number is unique per user
            'expiry_date' => 'sometimes|required|date_format:Y-m-d',
            'is_default' => 'boolean',
        ]);

        // If 'is_default' is true, make sure no other payment method is set as default for the same user
        if (isset($validatedData['is_default']) && $validatedData['is_default'] == true) {
            \App\Models\PaymentMethod::where('user_id', $paymentMethod->user_id)
                                    ->update(['is_default' => false]); // Set all other payment methods to not default
        }

        // Update the payment method
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
