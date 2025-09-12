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
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_line_id' => 'required|exists:order_lines,id',
            'rating_value' => 'required|integer|min:1|max:5',
            'comment' => 'sometimes|nullable|string|max:1000',
        ]);

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
        $userReview = \App\Models\UserReview::find($id);
        if (!$userReview) {
            return response()->json([
                'success' => false,
                'message' => 'User Review not found'
            ], 404);
        }

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
        $userReview = \App\Models\UserReview::find($id);
        if (!$userReview) {
            return response()->json([
                'success' => false,
                'message' => 'User Review not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'order_line_id' => 'sometimes|exists:order_lines,id',
            'rating_value' => 'sometimes|integer|min:1|max:5',
            'comment' => 'sometimes|nullable|string|max:1000',
        ]);

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
        $userReview = \App\Models\UserReview::find($id);
        if (!$userReview) {
            return response()->json([
                'success' => false,
                'message' => 'User Review not found'
            ], 404);
        }

        $userReview->delete();

        return response()->json([
            'success' => true,
            'message' => 'User Review deleted successfully'
        ]);
    }
}
