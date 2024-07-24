<?php

namespace App\Services\Interfaces;

use App\Models\Product;
use App\Models\Review;

/**
 * Interface ReviewServiceInterface
 * @package App\Services\Interfaces
 */
interface ReviewServiceInterface
{
    public function store($productId, $rating, $comment);
    public function show(Product $product);
    public function likeReview($reviewId, $userId);
    public function reportReview($reviewId, $userId);
    public function getAll();
    public function getDetails($review);

    /**
     * Delete a review and its related likes and reports.
     *
     * @param \App\Models\Review $review
     * @return bool
     */
    public function deleteReview(Review $review);
    public function getReviewsViaRating(Product $product, $rating);
    public function getLikedReviews($reviews);
    public function getReportedReviews($reviews);
    public function enhanceReviews($reviews);
}
