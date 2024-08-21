<?php

namespace App\Services;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\ReviewLike;
use App\Models\ReviewReport;
use App\Services\Interfaces\ReviewServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewService implements ReviewServiceInterface
{
    public function store($productId, $rating, $comment)
    {
        $userId = Auth::id();

        $purchases = OrderItem::whereHas('order', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('status', 'delivered');
        })->where('product_id', $productId)->count();

        $reviews = Review::where('product_id', $productId)
            ->where('user_id', $userId)
            ->count();

        if ($purchases == 0) {
            return ['warning' => 'Hãy mua sản phẩm trước khi đánh giá nó.'];
        } elseif ($reviews >= $purchases) {
            return ['warning' => 'Bạn chỉ có thể đánh giá sản phẩm với số lần bạn đã mua nó.'];
        }

        Review::create([
            'product_id' => $productId,
            'user_id' => $userId,
            'rating' => $rating,
            'comment' => $comment,
        ]);

        return ['success' => 'Gửi đánh giá thành công.'];
    }

    public function getReviewsViaRating(Product $product, $rating)
    {
        $query = $product->reviews()
            ->with('user')
            ->withCount('likes') // Đếm số lượng likes cho mỗi review
            ->orderBy('likes_count', 'desc')
            ->orderBy('created_at', 'desc');

        if ($rating !== 'all') {
            $query->where('rating', $rating);
        }

        return $query->paginate(5);
    }


    public function getLikedReviews($reviews)
    {
        if (!Auth::check()) {
            return [];
        }

        $userId = Auth::id();

        return $reviews->filter(function ($review) use ($userId) {
            return $review->likes->contains('user_id', $userId);
        })->pluck('id')->toArray();
    }

    public function getReportedReviews($reviews)
    {
        if (!Auth::check()) {
            return [];
        }

        $userId = Auth::id();

        return $reviews->filter(function ($review) use ($userId) {
            return $review->reports->contains('user_id', $userId);
        })->pluck('id')->toArray();
    }

    public function enhanceReviews($reviews)
    {
        $reviews->each(function ($review) {
            $review->total_likes = $review->likes()->count();
            $review->total_reports = $review->reports()->count();
        });
    }

    public function show(Product $product)
    {
        // Get paginated reviews
        $reviews_page = $product->reviews()
            ->with('user')
            ->withCount('likes') // Đếm số lượng likes cho mỗi review
            ->orderBy('likes_count', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // Get all reviews to calculate summaries
        $reviews = $product->reviews()->with(['user'])->get();

        $totalReviews = $reviews->count();

        $ratingsCount = $reviews->groupBy('rating')->map(function ($ratingGroup) {
            return $ratingGroup->count();
        });

        $ratingsSummary = [
            '1_star' => $ratingsCount->get(1, 0),
            '2_star' => $ratingsCount->get(2, 0),
            '3_star' => $ratingsCount->get(3, 0),
            '4_star' => $ratingsCount->get(4, 0),
            '5_star' => $ratingsCount->get(5, 0),
        ];

        $averageRating = round($reviews->avg('rating'), 1);
        $likedReviews = $this->getLikedReviews($reviews);
        $reportedReviews = $this->getReportedReviews($reviews);

        return [
            'reviews' => $reviews_page,
            'total_reviews' => $totalReviews,
            'ratings_summary' => $ratingsSummary,
            'average_rating' => $averageRating,
            'liked_reviews' => $likedReviews,
            'reported_reviews' => $reportedReviews,
        ];
    }

    public function likeReview($reviewId, $userId)
    {
        $like = ReviewLike::firstOrNew(['review_id' => $reviewId, 'user_id' => $userId]);

        if ($like->exists) {
            $like->delete();
            return ['status' => 'unliked'];
        } else {
            $like->save();
            return ['status' => 'liked'];
        }
    }

    public function reportReview($reviewId, $userId)
    {
        ReviewReport::create(['review_id' => $reviewId, 'user_id' => $userId]);
        return ['status' => 'reported'];
    }

    public function getAll()
    {
        $reviews = Review::with('user')
            ->withCount('reports')
            ->orderBy('reports_count', 'desc')
            ->paginate(10);

        $reviews->getCollection()->each(function ($review) {
            $review->total_likes = $review->likes()->count();
            $review->total_reports = $review->reports_count;
        });

        return $reviews;
    }


    public function getDetails($review)
    {
        $review->load(['product.main_image']);
        $review->total_likes = $review->likes()->count();
        $review->total_reports = $review->reports()->count();

        return $review;
    }

    public function deleteReview(Review $review)
    {
        try {
            DB::beginTransaction();

            $review->likes()->delete();
            $review->reports()->delete();
            $review->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
