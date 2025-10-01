<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userReviews = \App\Models\UserReview::all();
        return response()->json([
            'success' => true,
            'data' => $userReviews,
            'message' => 'User Reviews retrieved successfully'
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
            'order_line_id' => 'required|exists:order_lines,id',
            'rating_value' => 'required|integer|min:1|max:5',
            'comment' => 'sometimes|nullable|string|max:1000',
        ]);

        // Check if the user has already reviewed the same order line
        $existingReview = \App\Models\UserReview::where('user_id', $validatedData['user_id'])
                                                 ->where('order_line_id', $validatedData['order_line_id'])
                                                 ->first();

        if ($existingReview) {
            return response()->json([
                'success' => false,
                'message' => 'User has already reviewed this order line.'
            ], 400);
        }

        // Create the new review
        $userReview = \App\Models\UserReview::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $userReview,
            'message' => 'User Review created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the user review by ID, or return a 404 if not found
        $userReview = \App\Models\UserReview::with(['user', 'orderLine'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $userReview,
            'message' => 'User Review retrieved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the user review by ID, or return a 404 if not found
        $userReview = \App\Models\UserReview::findOrFail($id);

        // Validate the input data
        $validatedData = $request->validate([
            'rating_value' => 'sometimes|required|integer|min:1|max:5',
            'comment' => 'sometimes|nullable|string|max:1000',
        ]);

        // Update the review
        $userReview->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $userReview,
            'message' => 'User Review updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Find the user review by ID, or return a 404 if not found
    $userReview = \App\Models\UserReview::find($id);

    // If the user review doesn't exist, return a 404 error response
    if (!$userReview) {
        return response()->json([
            'success' => false,
            'message' => 'User Review not found'
        ], 404);
    }

    // Delete the user review
    $userReview->delete();

    // Return success response
    return response()->json([
        'success' => true,
        'message' => 'User Review deleted successfully'
    ]);
}


}
