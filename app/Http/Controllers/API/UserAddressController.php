<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $userAddresses = \App\Models\UserAddress::all();
        return response()->json([
            'success' => true,
            'data' => $userAddresses,
            'message' => 'User Addresses retrieved successfully'
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'address_id' => 'required|exists:addresses,id',
            'is_default' => 'sometimes|boolean'
        ]);

        // If is_default is true, unset previous default addresses for the user
        if (!empty($validatedData['is_default']) && $validatedData['is_default']) {
            \App\Models\UserAddress::where('user_id', $validatedData['user_id'])
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }

        $userAddress = \App\Models\UserAddress::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $userAddress,
            'message' => 'User Address created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userAddress = \App\Models\UserAddress::find($id);
        if (!$userAddress) {
            return response()->json([
                'success' => false,
                'message' => 'User Address not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $userAddress,
            'message' => 'User Address retrieved successfully'
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userAddress = \App\Models\UserAddress::find($id);
        if (!$userAddress) {
            return response()->json([
                'success' => false,
                'message' => 'User Address not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'address_id' => 'sometimes|exists:addresses,id',
            'is_default' => 'sometimes|boolean'
        ]);

        // If is_default is true, unset previous default addresses for the user
        if (isset($validatedData['is_default']) && $validatedData['is_default']) {
            \App\Models\UserAddress::where('user_id', $userAddress->user_id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }

        $userAddress->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $userAddress,
            'message' => 'User Address updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userAddress = \App\Models\UserAddress::find($id);
        if (!$userAddress) {
            return response()->json([
                'success' => false,
                'message' => 'User Address not found'
            ], 404);
        }

        $userAddress->delete();

        return response()->json([
            'success' => true,
            'message' => 'User Address deleted successfully'
        ]);
    }
}
