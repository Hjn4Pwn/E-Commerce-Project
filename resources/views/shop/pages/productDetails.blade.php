@extends('shop.layout')

@section('content')
    {{-- @include('shop.components.navbar') --}}
    @include('shop.components.pageHeader', [
        'activeHome' => 'active',
        'categories' => $categories,
    ])
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">

                    @include('shop.components.breadcrumb', [
                        'subpage' => $product->name,
                    ])

                    <div class="row justify-content-center">
                        <div class="col-md-10 bg-white p-5">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex justify-content-center">
                                    <div class="product-imgs">
                                        <div class="img-display">
                                            <div class="img-showcase">
                                                @php
                                                    $i = 0;
                                                    $j = 0;
                                                    $cntImg = $product->images->count();
                                                @endphp
                                                @foreach ($product->images as $image)
                                                    <img src="{{ asset($image->path) }}"
                                                        alt="Product Image {{ ++$i }}" class="product-img">
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="img-select">
                                            @foreach ($product->images as $image)
                                                <div class="img-item">
                                                    <a href="#" data-id="{{ ++$j }}" class="">
                                                        <img src="{{ asset($image->path) }}"
                                                            alt="Product Thumbnail {{ $j }}"
                                                            class="product-img {{ $j == 1 ? 'active' : '' }}"
                                                            @if ($cntImg == 1) style="width: 25%;"
                                                        @elseif ($cntImg == 2) style="width: 50%;"
                                                        @elseif ($cntImg == 3) style="width: 75%;" @endif>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <h2 class="mb-3 mt-3">{{ $product->name }}</h2>
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center" style="line-height: 45px">
                                            <div class="star-ratings">
                                                <div class="fill-ratings" style="width: {{ $average_rating * 20 }}%;">
                                                    <span>★★★★★</span>
                                                </div>
                                                <div class="empty-ratings">
                                                    <span>★★★★★</span>
                                                </div>
                                            </div>
                                            <a href="#product-rating" style="text-decoration: none;">
                                                <span class="text-info ml-3 f-16">(Xem {{ format_to_k($total_reviews) }}
                                                    đánh giá)</span>
                                            </a>
                                            <span class="text-normal ml-4 f-14 mt-1">Đã bán
                                                {{ format_to_k($product->quantity_sold) }}</span>
                                        </div>
                                    </div>
                                    @php
                                        $originalPrice = round($product->price / (1 - $product->sale / 100), -3);
                                        $savingAmount = round($originalPrice - $product->price, -3);
                                    @endphp

                                    <div style="display: flex; align-items: center;">
                                        <h4 class="mr-3 mb-0 text-info">{{ format_currency($product->price) }}</h4>
                                        @if ($product->sale)
                                            <h4 class="mr-3 mb-0" style="color: #6c757d; font-size:16px;">
                                                <del>{{ format_currency($originalPrice) }}</del>
                                            </h4>
                                            <span class="badge badge-danger"
                                                style="font-size: 18px;">-{{ $product->sale }}%</span>
                                        @endif
                                    </div>
                                    @if ($product->sale)
                                        <div>
                                            <span>Tiết kiệm </span> <span
                                                class="text-danger">{{ format_currency($savingAmount) }}</span>
                                        </div>
                                    @endif

                                    <div class="mt-4 custom-ul-original">
                                        {!! $product->short_description !!}
                                    </div>
                                    <div>
                                        <span>Hương vị:</span>
                                        @foreach ($flavors as $flavor)
                                            <div class="form-check ml-5">
                                                <input class="form-check-input" type="radio" name="flavor_id"
                                                    id="flavor_{{ $flavor['id'] }}" value="{{ $flavor['id'] }}"
                                                    data-quantity="{{ $flavor['quantity'] }}"
                                                    @if ($flavor['quantity'] == 0) disabled @endif>
                                                <label class="form-check-label" for="flavor_{{ $flavor['id'] }}">
                                                    {{ $flavor['name'] }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-5 mb-5">
                                        <label class="mr-3">Số lượng:</label>
                                        <input type="number" id="quantity" class="text-center w-25" value="1"
                                            min="1" max="1">
                                        @if ($isOutOfStock)
                                            <p class="text-danger f-18" id="available-quantity">Sản phẩm đã hết hàng.</p>
                                        @else
                                            <p class="text-info f-16" id="available-quantity">Chọn hương vị để biết số lượng
                                                có sẵn.</p>
                                        @endif
                                    </div>

                                    <div class="d-flex">
                                        <form id="add-to-cart-form" method="POST" action="{{ route('cart.add') }}"
                                            onsubmit="return submitAddToCartForm()">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" id="form-quantity" value="1">
                                            <input type="hidden" name="flavor_id" id="form-flavor-id" value="">

                                            <button type="submit" class="btn btn-outline-primary font-weight-bold"
                                                style="text-transform: none">Thêm vào
                                                giỏ hàng</button>
                                        </form>
                                        {{-- <a href="#" class="btn btn-outline-success font-weight-bold"
                                            role="button">Buy Now</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3"></div>

                    <div class="row justify-content-center">
                        <div class="col-md-10 bg-white p-5">
                            <h5 class="mb-2">MÔ TẢ SẢN PHẨM</h5>
                            <div class="content" id="moreText" style="overflow:hidden; height: 100px;">
                                {!! $product->description !!}
                            </div>
                            <button id="expandBtn" class="btn btn-info w-100 shadow-button"><i
                                    class="fa-solid fa-plus mr-2"></i>Xem
                                thêm</button>
                            <button id="collapseBtn" class="btn btn-secondary mt-2 w-100 " style="display:none;"><i
                                    class="fa-solid fa-minus mr-2"></i>Thu
                                gọn</button>
                        </div>
                    </div>

                    <div class="row mt-3"></div>
                    <div class="row justify-content-center">
                        {{--  --}}
                    </div>
                    <div class="row justify-content-center" id="product-rating">
                        <div class="col-md-10 bg-white pt-5 pr-5 pl-5 pb-2">
                            <h5>ĐÁNH GIÁ SẢN PHẨM</h5>
                            <div class="header-rating row pt-3 pb-3">
                                <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                    <div class="text-center">
                                        <span class="text-danger mb-3  f-30">{{ $average_rating }}/5</span>
                                    </div>
                                    <div class="star-center">
                                        <div class="star-ratings">
                                            <div class="fill-ratings" style="width: {{ $average_rating * 20 }}%;">
                                                <span>★★★★★</span>
                                            </div>
                                            <div class="empty-ratings">
                                                <span>★★★★★</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <span class="mb-3 f-18">({{ format_to_k($total_reviews) }} đánh giá)</span>
                                    </div>


                                    {{-- ---- --}}
                                    <!-- Button trigger modal -->
                                    <div class="mt-4 mb-4 text-center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModalCenter">
                                            Đánh giá
                                        </button>
                                    </div>
                                    <!-- Modal -->
                                    <form id="review-form" method="POST"
                                        action="{{ route('review.store', ['product' => $product->id]) }}">
                                        @csrf
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-info font-weight-bold"
                                                            id="exampleModalLongTitle">Đánh giá</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="review-errors" class="alert alert-danger"
                                                            style="display: none;">
                                                            <ul id="error-list"></ul>
                                                        </div>
                                                        <div class="">
                                                            <span>Đánh giá của bạn về sản phẩm:</span>
                                                            <div class="rating">
                                                                <input type="radio" name="rating" value="5"
                                                                    id="5"><label for="5">☆</label>
                                                                <input type="radio" name="rating" value="4"
                                                                    id="4"><label for="4">☆</label>
                                                                <input type="radio" name="rating" value="3"
                                                                    id="3"><label for="3">☆</label>
                                                                <input type="radio" name="rating" value="2"
                                                                    id="2"><label for="2">☆</label>
                                                                <input type="radio" name="rating" value="1"
                                                                    id="1"><label for="1">☆</label>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <textarea class="form-control" name="comment" rows="3" placeholder="Nhập nội dung đánh giá tại đây..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            style="z-index: 1;">Gửi đánh
                                                            giá</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    {{-- ---- --}}
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                                    <button type="button" class="btn-rating btn bg-white mr-3 mb-2"
                                        data-rating="all">Tất
                                        cả</button>
                                    <button type="button" class="btn-rating btn bg-white mr-3 mb-2" data-rating="5">5
                                        sao ({{ format_to_k($ratings_summary['5_star']) }})</button>
                                    <button type="button" class="btn-rating btn bg-white mr-3 mb-2" data-rating="4">4
                                        sao ({{ format_to_k($ratings_summary['4_star']) }})</button>
                                    <button type="button" class="btn-rating btn bg-white mr-3 mb-2" data-rating="3">3
                                        sao ({{ format_to_k($ratings_summary['3_star']) }})</button>
                                    <button type="button" class="btn-rating btn bg-white mr-3 mb-2" data-rating="2">2
                                        sao ({{ format_to_k($ratings_summary['2_star']) }})</button>
                                    <button type="button" class="btn-rating btn bg-white mr-3 mb-2" data-rating="1">1
                                        sao ({{ format_to_k($ratings_summary['1_star']) }})</button>
                                </div>
                            </div>


                            <div class="mt-5" id="reviews-container">
                                @if ($reviews->isNotEmpty())
                                    @foreach ($reviews as $review)
                                        <div class="per-rating mb-5">
                                            <div class="d-flex align-items-center">
                                                <span class="font-weight-bold mr-2">{{ $review->user->name }}</span>
                                                <div class="star-ratings-comment">
                                                    <div class="fill-ratings"
                                                        style="width: {{ $review->rating * 20 }}%;">
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
                                                            <button type="submit"
                                                                class="btn btn-link comment-actions__link"
                                                                style="text-decoration: none;">
                                                                <i class="fa-solid fa-thumbs-up comment-actions__icon comment-actions__icon-like"
                                                                    style="color: {{ auth()->check() && in_array($review->id, $liked_reviews) ? '#007bff' : 'gray' }}"></i>
                                                                <span
                                                                    class="comment-actions__text f-16 like-number">{{ $review->likes_count }}</span>
                                                                <span class="comment-actions__text f-16">Thích</span>
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li class="comment-actions__item mr-3">
                                                        <form class="report-form" data-review-id="{{ $review->id }}">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-link comment-actions__link"
                                                                {{ auth()->check() && in_array($review->id, $reported_reviews) ? 'disabled' : '' }}
                                                                style="cursor: {{ auth()->check() && in_array($review->id, $reported_reviews) ? 'not-allowed' : 'pointer' }}; text-decoration: none;">
                                                                <i class="fa-solid fa-triangle-exclamation comment-actions__icon comment-actions__icon-report"
                                                                    style="color: {{ auth()->check() && in_array($review->id, $reported_reviews) ? 'red' : '#007bff' }}"></i>
                                                                <span
                                                                    class="comment-actions__text comment-actions__text-report f-16"
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
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Page-body end -->
        <div class="mb-5"></div>
    </div>

    {{-- rating star --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var star_rating_width = $('.fill-ratings span').width();
            $('.star-ratings').width(star_rating_width);
        });
    </script>

    {{-- active product image --}}
    <script>
        document.querySelectorAll('.img-item a').forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault();

                // Xóa class 'active' khỏi tất cả các hình ảnh
                document.querySelectorAll('.img-item img').forEach(img => {
                    img.classList.remove('active');
                });

                // Thêm class 'active' cho hình ảnh được nhấp vào
                const img = item.querySelector('img');
                img.classList.add('active');

                // Cập nhật hình ảnh hiển thị chính
                const displayImage = document.querySelector('.img-showcase img');
                displayImage.src = img.src;
                displayImage.alt = img.alt;

                // Đặt lại và chạy hàm slideImage với ID mới
                const imgId = parseInt(item.getAttribute('data-id'));
                slideImage(imgId);
            });
        });

        function slideImage(imgId) {
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;
            document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
        }

        window.addEventListener('resize', function() {
            const activeImgId = document.querySelector('.img-item img.active').parentNode.getAttribute('data-id');
            slideImage(parseInt(activeImgId));
        });
    </script>

    {{-- xem thêm - thu gọn description  --}}
    <script>
        document.getElementById('expandBtn').addEventListener('click', function() {
            // Mở rộng nội dung
            document.getElementById('moreText').style.height = 'auto';
            // Ẩn nút Xem thêm và hiển thị nút Thu gọn
            document.getElementById('expandBtn').style.display = 'none';
            document.getElementById('collapseBtn').style.display = 'inline';
        });

        document.getElementById('collapseBtn').addEventListener('click', function() {
            // Thu gọn nội dung
            document.getElementById('moreText').style.height = '120px';
            // Hiển thị nút Xem thêm và ẩn nút Thu gọn
            document.getElementById('expandBtn').style.display = 'inline';
            document.getElementById('collapseBtn').style.display = 'none';
        });
    </script>

    {{-- add to cart --}}
    <script>
        function submitAddToCartForm() {
            const quantity = document.getElementById('quantity').value;
            const flavorElement = document.querySelector('input[name="flavor_id"]:checked');
            if (!flavorElement) {
                alert('Vui lòng chọn hương vị.');
                return false;
            }
            const flavorId = flavorElement.value;

            document.getElementById('form-quantity').value = quantity;
            document.getElementById('form-flavor-id').value = flavorId;

            return true;
        }

        document.querySelectorAll('input[name="flavor_id"]').forEach(flavorRadio => {
            flavorRadio.addEventListener('change', function() {
                const maxQuantity = this.dataset.quantity;
                document.getElementById('quantity').max = maxQuantity;
                document.getElementById('quantity').value = 1; // Reset quantity to 1 when flavor changes
                document.getElementById('available-quantity').innerText = `${maxQuantity} sản phẩm có sẵn.`;
            });
        });

        document.getElementById('quantity').addEventListener('input', function() {
            const maxQuantity = parseInt(this.max);
            if (parseInt(this.value) > maxQuantity) {
                this.value = maxQuantity;
            }
        });
    </script>

    {{-- btn-active --}}
    <script>
        $(document).ready(function() {
            $('.btn-rating').on('click', function() {
                $('.btn-rating').removeClass('btn-active');
                $('.btn-rating').removeClass('text-primary');
                $(this).addClass('btn-active');
                $(this).addClass('text-primary');
            });
        });
    </script>

    {{-- review --}}
    <script>
        $(document).ready(function() {
            $('#review-form').on('submit', function(event) {
                event.preventDefault();

                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(response) {
                        if (response.status === 401) {
                            // If the user is not authorized, redirect to the login page
                            window.location.href = '/login';
                        } else {
                            var errors = response.responseJSON.errors;
                            var errorList = '';

                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorList += '<li>' + errors[key][0] + '</li>';
                                }
                            }

                            $('#review-errors').show();
                            $('#error-list').html(errorList);
                        }
                    }
                });
            });
        });
    </script>

    {{-- render rating star number --}}
    <script>
        $(document).ready(function() {
            $('.btn-rating').on('click', function() {
                var rating = $(this).data('rating');
                var productId = {{ $product->id }}; // Ensure product ID is correctly embedded
                // console.log(productId);
                $.ajax({
                    type: 'GET',
                    url: `/product/${productId}/reviews`,
                    data: {
                        rating: rating
                    },
                    success: function(response) {
                        $('#reviews-container').html(response);
                    },
                    error: function(response) {
                        console.error('Error fetching reviews:', response);
                    }
                });
            });
        });
    </script>

    {{-- show more comment --}}
    <script>
        function toggleReadMore(element) {
            var content = element.previousElementSibling;
            if (content.classList.contains('expanded')) {
                content.classList.remove('expanded');
                element.textContent = '... Xem thêm';
            } else {
                content.classList.add('expanded');
                element.textContent = 'Thu gọn';
            }
        }
    </script>

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


@endsection
