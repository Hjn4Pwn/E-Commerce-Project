@if ($reviews->isNotEmpty())
    @foreach ($reviews as $review)
        <div class="per-rating mb-5">
            <div class="d-flex align-items-center">
                <span class="font-weight-bold mr-2">{{ $review->user->name }}</span>
                <div class="star-ratings-comment">
                    <div class="fill-ratings" style="width: {{ $review->rating * 20 }}%;">
                        <span>★★★★★</span>
                    </div>
                    <div class="empty-ratings">
                        <span>★★★★★</span>
                    </div>
                </div>
            </div>
            <div class="mt-2 mb-2">
                <div class="comment-content">{{ $review->comment }}</div>
                @if (strlen($review->comment) > 370)
                    <span class="read-more" onclick="toggleReadMore(this)">Xem thêm</span>
                @endif
            </div>
            <div>
                <ul class="list-unstyled d-flex align-items-center mb-0 comment-actions">
                    <li class="comment-actions__item mr-3">
                        <form class="like-form" data-review-id="{{ $review->id }}">
                            @csrf
                            <button type="submit" class="btn btn-link comment-actions__link"
                                style="text-decoration: none;">
                                <i class="fa-solid fa-thumbs-up comment-actions__icon comment-actions__icon-like"
                                    style="color: {{ auth()->check() && in_array($review->id, $liked_reviews) ? '#007bff' : 'gray' }}"></i>
                                <span class="comment-actions__text f-16 like-number">{{ $review->likes_count }}</span>
                                <span class="comment-actions__text f-16">Thích</span>
                            </button>
                        </form>
                    </li>
                    <li class="comment-actions__item mr-3">
                        <form class="report-form" data-review-id="{{ $review->id }}">
                            @csrf
                            <button type="submit" class="btn btn-link comment-actions__link"
                                {{ auth()->check() && in_array($review->id, $reported_reviews) ? 'disabled' : '' }}
                                style="cursor: {{ auth()->check() && in_array($review->id, $reported_reviews) ? 'not-allowed' : 'pointer' }}; text-decoration: none;">
                                <i class="fa-solid fa-triangle-exclamation comment-actions__icon comment-actions__icon-report"
                                    style="color: {{ auth()->check() && in_array($review->id, $reported_reviews) ? 'red' : '#007bff' }}"></i>
                                <span class="comment-actions__text comment-actions__text-report f-16"
                                    style="color: {{ auth()->check() && in_array($review->id, $reported_reviews) ? 'red' : '#007bff' }}">
                                    Báo cáo
                                </span>
                            </button>
                        </form>
                    </li>
                    <li class="comment-actions__item mr-3">
                        <span
                            class="comment-actions__time f-16">{{ format_date_to_ho_chi_minh_timezone($review->created_at) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    @endforeach

    <div class="row justify-content-center">
        {{ $reviews->links() }}
    </div>
@else
    <div class="text-center text-info">
        <span class="f-20">Chưa có đánh giá nào.</span>
    </div>
@endif


{{-- like & unlike --}}
<script>
    $(document).ready(function() {
        // Xử lý sự kiện submit trên form like
        $('.like-form').on('submit', function(event) {
            event.preventDefault(); // Chặn sự kiện submit mặc định

            var form = $(this);
            var reviewId = form.data('review-id'); // Lấy review id từ data attribute
            var formData = form.serialize(); // Lấy dữ liệu form bao gồm CSRF token
            var element = form.find(
                '.comment-actions__link'); // Lưu lại phần tử để cập nhật giao diện sau khi xử lý

            // Gửi yêu cầu AJAX
            $.ajax({
                type: 'POST',
                url: `/reviews/${reviewId}/like`,
                data: formData,
                success: function(response) {
                    var icon = element.find('.comment-actions__icon-like');
                    var likeCountSpan = element.find('.like-number').first();

                    if (response.status === 'liked') {
                        icon.css('color', '#007bff'); // Đổi màu icon khi liked
                        likeCountSpan.text(parseInt(likeCountSpan.text()) + 1);
                    } else if (response.status === 'unliked') {
                        icon.css('color', 'gray'); // Đổi màu icon khi unliked
                        likeCountSpan.text(parseInt(likeCountSpan.text()) - 1);
                    }
                },
                error: function(response) {
                    if (response.status === 401) {
                        // If the user is not authorized, redirect to the login page
                        window.location.href = '/login';
                    }
                    console.error('Error liking review:', response);
                }
            });
        });
    });
</script>

{{-- report --}}
<script>
    $(document).ready(function() {
        // Xử lý sự kiện submit trên form like
        $('.report-form').on('submit', function(event) {
            event.preventDefault(); // Chặn sự kiện submit mặc định

            var form = $(this);
            var reviewId = form.data('review-id'); // Lấy review id từ data attribute
            var formData = form.serialize(); // Lấy dữ liệu form bao gồm CSRF token
            var element = form.find('.comment-actions__link');
            var button = form.find('button');

            // Gửi yêu cầu AJAX
            $.ajax({
                type: 'POST',
                url: `/reviews/${reviewId}/report`,
                data: formData,
                success: function(response) {
                    var icon = element.find('.comment-actions__icon-report');
                    var text = element.find('.comment-actions__text-report');

                    if (response.status === 'reported') {
                        icon.css('color', 'red');
                        text.css('color', 'red');
                        button.prop('disabled', true); // Disable the button
                        button.css('cursor', 'not-allowed'); // Change cursor to not-allowed
                    } else {
                        alert('Failed to report the review.');
                    }
                },
                error: function(response) {
                    if (response.status === 401) {
                        window.location.href = '/login';
                    } else {
                        alert('Error reporting the review. Please try again.');
                    }
                    console.error('Error reporting review:', response);
                }
            });
        });
    });
</script>
