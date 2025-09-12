<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $addresses = \App\Models\Address::all();
        return response()->json([
            'success' => true,
            'data' => $addresses,
            'message' => 'Addresses retrieved successfully'
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'unit_number' => 'nullable|string|max:50',
            'street_number' => 'nullable|string|max:50',
            'country_name' => 'nullable|string|max:255',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'region' => 'nullable|string|max:100',
            'postal_code' => 'required|string|max:20'
        ]);

        $address = \App\Models\Address::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $address,
            'message' => 'Address created successfully'
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $address = \App\Models\Address::find($id);
        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $address,
            'message' => 'Address retrieved successfully'
        ]);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $address = \App\Models\Address::find($id);
        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'unit_number' => 'nullable|string|max:50',
            'street_number' => 'nullable|string|max:50',
            'country_name' => 'sometimes|string|max:255',
            'address_line1' => 'sometimes|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'sometimes|string|max:100',
            'state' => 'sometimes|string|max:100',
            'postal_code' => 'sometimes|string|max:20',
            
        ]);

        $address->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $address,
            'message' => 'Address updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = \App\Models\Address::find($id);
        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found'
            ], 404);
        }
        $address->delete();
        return response()->json([
            'success' => true,
            'message' => 'Address deleted successfully'
        ]);
    }
}
