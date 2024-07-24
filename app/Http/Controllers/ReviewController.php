<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Services\Interfaces\ReviewServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(
        ReviewServiceInterface $reviewService,
    ) {
        $this->reviewService = $reviewService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = $this->reviewService->getAll();
        // dd($reviews);
        return view('admin.pages.review.reviews', [
            'page' => 'Reviews',
            'reviews' => $reviews,
        ]);
    }

    public function admin_show(Review $review)
    {
        $reviewData = $this->reviewService->getDetails($review);
        // dd($reviewData);
        return view('admin.pages.review.showReview', [
            'parentPage' => ['Reviews', 'admin.reviews.index'],
            'childPage' => 'Review Details',
            'reviewData' => $reviewData,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        $result = $this->reviewService->store(
            $product->id,
            $validatedData['rating'],
            $validatedData['comment']
        );

        if (isset($result['warning'])) {
            return back()->with('warning', $result['warning']);
        }

        return back()->with('success', $result['success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Product $product)
    {
        $rating = $request->query('rating');
        $reviews = $this->reviewService->getReviewsViaRating($product, $rating);

        $liked_reviews = $this->reviewService->getLikedReviews($reviews);
        $reported_reviews = $this->reviewService->getReportedReviews($reviews);

        $this->reviewService->enhanceReviews($reviews);

        return view('shop.pages.partial_reviews', [
            'reviews' => $reviews,
            'liked_reviews' => $liked_reviews,
            'reported_reviews' => $reported_reviews,
        ]);
    }


    public function like(Review $review)
    {
        $userId = Auth::id();
        $result = $this->reviewService->likeReview($review->id, $userId);

        return response()->json(['status' => $result['status']]);
    }

    public function report(Review $review)
    {
        $userId = Auth::id();
        $result = $this->reviewService->reportReview($review->id, $userId);

        return response()->json(['status' => $result['status']]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        if ($this->reviewService->deleteReview($review)) {
            return redirect()->route('admin.reviews.index')->with('success', 'Delete review successfully');
        }
        return back()->withErrors('Failed to delete review.');
    }
}
