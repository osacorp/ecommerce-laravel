<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    /**
     * Handles the request to store a new review.
     * 
     * @param ReviewRequest $request The request object containing review details.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating success and the saved review.
     */
    public function store(ReviewRequest $request)
    {
        $review = new Review();
        $review->user_id = auth()->id();
        $review->product_id = $request->product_id;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->approved = false; // Reviews are not approved by default
        $review->save();

        return response()->json(['message' => 'Review submitted successfully', 'review' => $review], 201);
    }

    public function approve($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->approve();
        return response()->json(['message' => 'Review approved successfully']);
    }

    public function show($productId)
    {
        $reviews = Review::where('product_id', $productId)->where('approved', true)->get();
        return response()->json($reviews);
    }
}
/**
 * ReviewController manages review-related actions such as storing, approving, and displaying reviews.
 */
    public function show($productId)
    {
        $reviews = Review::where('product_id', $productId)->where('approved', true)->get();
        return response()->json($reviews);
    }
}
    public function show($productId)
    {
        $reviews = Review::where('product_id', $productId)->where('approved', true)->get();
        return response()->json($reviews);
    }
}
