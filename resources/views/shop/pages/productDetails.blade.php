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
                                                <div class="fill-ratings" style="width: 86%;">
                                                    <span>★★★★★</span>
                                                </div>
                                                <div class="empty-ratings">
                                                    <span>★★★★★</span>
                                                </div>
                                            </div>
                                            <a href="#product-rating" style="text-decoration: none;">
                                                <span class="text-info ml-3 f-16">(Xem 4 đánh giá)</span>
                                            </a>
                                            <span class="text-normal ml-4 f-14 mt-1">Đã bán
                                                {{ $product->quantity_sold }}</span>

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
                                                    id="flavor_{{ $flavor->id }}" value="{{ $flavor->id }}">
                                                <label class="form-check-label" for="flavor_{{ $flavor->id }}">
                                                    {{ $flavor->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-5 mb-5">
                                        <label class="mr-3">Số lượng:</label>
                                        <input type="number" id="quantity" class="text-center w-25" value="1"
                                            min="1" max="{{ $product->quantity }}">
                                        <p class="text-info f-16">{{ $product->quantity }} sản phẩm có sẵn.</p>
                                    </div>

                                    <div class="d-flex">
                                        <form id="add-to-cart-form" method="POST" action="{{ route('cart.add') }}"
                                            onsubmit="return submitAddToCartForm()">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" id="form-quantity" value="1">
                                            <input type="hidden" name="flavor_id" id="form-flavor-id" value="">

                                            <button type="submit" class="btn btn-outline-primary font-weight-bold">Add to
                                                Cart</button>
                                        </form>
                                        <a href="#" class="btn btn-outline-success font-weight-bold"
                                            role="button">Buy Now</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row mt-3"></div>

                    <div class="row justify-content-center">
                        <div class="col-md-10 bg-white p-5">
                            <h5>MÔ TẢ SẢN PHẨM</h5>
                            <div class="content" id="moreText" style="overflow:hidden; height: 100px;">
                                {!! $product->description !!}
                            </div>
                            <button id="expandBtn" class="btn btn-info mt-2 w-100"><i class="fa-solid fa-plus mr-2"></i>Xem
                                thêm</button>
                            <button id="collapseBtn" class="btn btn-info mt-2 w-100" style="display:none;"><i
                                    class="fa-solid fa-minus mr-2"></i>Thu
                                gọn</button>
                        </div>
                    </div>

                    <div class="row mt-3"></div>

                    <div class="row justify-content-center" id="product-rating">
                        <div class="col-md-10 bg-white pt-5 pr-5 pl-5 pb-2">
                            <h5>ĐÁNH GIÁ SẢN PHẨM</h5>
                            <div class="header-rating row pt-3 pb-3">
                                <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                    <div class="text-center">
                                        <span class="text-danger mb-3  f-30">4.9/5</span>
                                    </div>
                                    <div class="star-center">
                                        <div class="star-ratings">
                                            <div class="fill-ratings" style="width: 86%;">
                                                <span>★★★★★</span>
                                            </div>
                                            <div class="empty-ratings">
                                                <span>★★★★★</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <span class="mb-3 f-18">(2 đánh giá)</span>
                                    </div>

                                    <div class="mt-4 mb-4 text-center">
                                        <button type="button" class="btn btn-primary">Đánh giá</button>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                                    <button type="button" class="btn bg-white mr-3 mb-2">Tất cả</button>
                                    <button type="button" class="btn bg-white mr-3 mb-2">5 sao (2.4k)</button>
                                    <button type="button" class="btn bg-white mr-3 mb-2">4 sao (80)</button>
                                    <button type="button" class="btn bg-white mr-3 mb-2">3 sao (22)</button>
                                    <button type="button" class="btn bg-white mr-3 mb-2">1 sao (10)</button>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="per-rating mb-5">
                                    <div class="d-flex align-items-center">
                                        <span class="font-weight-bold mr-2">Huy Na</span>
                                        <div class="star-ratings">
                                            <div class="fill-ratings f-18" style="width: 86%;">
                                                <span>★★★★★</span>
                                            </div>
                                            <div class="empty-ratings f-18">
                                                <span>★★★★★</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2">
                                        Xin hỏi dùng có bị mất ngủ ko ạ?
                                    </div>
                                    <div>
                                        <ul class="list-unstyled d-flex align-items-center mb-0 comment-actions">
                                            <li class="comment-actions__item mr-3 ">
                                                <a href="#" class="comment-actions__link"
                                                    onclick="toggleLike(this);">
                                                    <i
                                                        class="fa-solid fa-thumbs-up comment-actions__icon comment-actions__icon-like"></i>
                                                    <span class="comment-actions__text f-16">0</span>
                                                    <span class="comment-actions__text f-16">Hữu ích</span>
                                                </a>

                                            </li>
                                            <li class="comment-actions__item mr-3">
                                                <a href="#" class="comment-actions__link">
                                                    <i
                                                        class="fa-solid fa-triangle-exclamation comment-actions__icon comment-actions__icon-report "></i>
                                                    <span
                                                        class="comment-actions__text comment-actions__text-report f-16">Báo
                                                        cáo</span>
                                                </a>
                                            </li>
                                            <li class="comment-actions__item mr-3">
                                                <span class="comment-actions__time f-16">17:16 14/06/2023</span>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <div class="per-rating mb-5">
                                    <div class="d-flex align-items-center">
                                        <span class="font-weight-bold mr-2">Huy Na</span>
                                        <div class="star-ratings">
                                            <div class="fill-ratings f-18" style="width: 86%;">
                                                <span>★★★★★</span>
                                            </div>
                                            <div class="empty-ratings f-18">
                                                <span>★★★★★</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2">
                                        Ostrovit Creatine là sản phẩm cung cấp Creatine Monohydrate tinh khiết nhất của nhà
                                        Ostrovit cho tới thời điểm hiện tại. Với sự cải tiến vượt bậc khi áp dụng công thức,
                                        mẫu
                                        mã mới đi kèm với đó là những cái chất rất riêng mà chỉ Ostrovit Creatine có được
                                        như:
                                        Đa dạng về hương vị và giá thành dễ tiếp cận, chắc chắn Ostrovit Creatine là một
                                        trong
                                        dòng Creatine tốt, được nhiều tin tưởng sử dụng nhất hiện nay.
                                    </div>
                                    <div>
                                        <ul class="list-unstyled d-flex align-items-center mb-0 comment-actions">
                                            <li class="comment-actions__item mr-3 ">
                                                <a href="#" class="comment-actions__link"
                                                    onclick="toggleLike(this);">
                                                    <i
                                                        class="fa-solid fa-thumbs-up comment-actions__icon comment-actions__icon-like"></i>
                                                    <span class="comment-actions__text f-16">5</span>
                                                    <span class="comment-actions__text f-16">Hữu ích</span>
                                                </a>

                                            </li>
                                            <li class="comment-actions__item mr-3">
                                                <a href="#" class="comment-actions__link">
                                                    <i
                                                        class="fa-solid fa-triangle-exclamation comment-actions__icon comment-actions__icon-report "></i>
                                                    <span
                                                        class="comment-actions__text comment-actions__text-report f-16">Báo
                                                        cáo</span>
                                                </a>
                                            </li>
                                            <li class="comment-actions__item mr-3">
                                                <span class="comment-actions__time f-16">17:16 14/06/2023</span>
                                            </li>
                                        </ul>

                                    </div>

                                </div>
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
            document.getElementById('moreText').style.height = '100px';
            // Hiển thị nút Xem thêm và ẩn nút Thu gọn
            document.getElementById('expandBtn').style.display = 'inline';
            document.getElementById('collapseBtn').style.display = 'none';
        });
    </script>

    {{-- btn active --}}
    <script>
        $(document).ready(function() {
            $('.btn').on('click', function() {
                $('.btn').removeClass('btn-active');
                $('.btn').removeClass('text-primary');
                $(this).addClass('btn-active');
                $(this).addClass('text-primary');
            });
        });
    </script>

    {{-- action like --}}
    <script>
        document.querySelectorAll('.comment-actions__item:nth-child(1) .comment-actions__link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Chặn sự kiện mặc định
                var icon = this.querySelector('.comment-actions__icon');
                icon.style.color = (icon.style.color === 'rgb(0, 123, 255)' ? 'gray' :
                    '#007bff'); // Toggle màu sắc
            });
        });

        function toggleLike(element) {
            element.classList.toggle('liked');
        }
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
    </script>

    {{-- quantity max available prods --}}
    <script>
        document.getElementById('quantity').addEventListener('input', function() {
            const maxQuantity = {{ $product->quantity }};
            if (this.value > maxQuantity) {
                this.value = maxQuantity;
            }
        });
    </script>
@endsection
