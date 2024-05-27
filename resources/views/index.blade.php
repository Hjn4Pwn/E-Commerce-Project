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
                    {{-- slider --}}
                    @include('shop.components.slider')
                    {{-- ---- --}}

                    {{-- @if ($action == 'getAll')
                        @if ($categories->count())
                            @foreach ($categories as $category)
                                <div class="prod-by-category">

                                    <div>
                                        <span>{{ $category->name }}</span>
                                    </div>

                                    <div class="row">
                                        @php
                                            $products = $category->products;
                                        @endphp
                                        @if ($products->count())
                                            @foreach ($products as $product)
                                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 col-lg-2_4 p-b-20">
                                                    <div class="card mx-auto product-card">
                                                        <div onclick="location.href='#';" style="cursor: pointer;">
                                                            <div class="text-center">
                                                                <img src={{ asset($product->main_image->path) }}
                                                                    class="card-img-top" alt="...">
                                                            </div>
                                                            <div class="card-body">
                                                                <h5 class="card-title">{{ $product->name }}</h5>

                                                                <div class="mb-3 mt-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="star-ratings" style="font-size: 16px;">
                                                                            <div class="fill-ratings d-flex"
                                                                                style="width: 86%;">
                                                                                <span>★★★★★</span>
                                                                            </div>
                                                                            <div class="empty-ratings">
                                                                                <span>★★★★★</span>
                                                                            </div>
                                                                        </div>
                                                                        <span class="text-normal ml-2 f-14 mt-1">Đã bán
                                                                            {{ $product->quantity_sold }}</span>
                                                                    </div>
                                                                </div>

                                                                <div style="display: flex; align-items: center;">
                                                                    <h6 class="mr-2 mb-0 text-danger">{{ $product->price }}₫
                                                                    </h6>
                                                                    @if ($product->sale)
                                                                        <h5 class="mr-2 mb-0"
                                                                            style="color: #6c757d; font-size:13px;">
                                                                            <del>{{ ($product->price * (100 + $product->sale)) / 100 }}₫</del>
                                                                        </h5>
                                                                        <span class="badge badge-danger"
                                                                            style="font-size: 14px;">-{{ $product->sale }}%</span>
                                                                    @endif
                                                                </div>

                                                                <div class="text-right mt-3">
                                                                    <a href="#" class=" "
                                                                        style="border-radius: 6rem;">
                                                                        <i class="fa-solid fa-cart-plus f-30 text-info"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <h4 class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">No products
                                                available</h4>
                                        @endif

                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @else
                        <div class="prod-by-category">

                            <div>
                                <span>{{ $selectedCategory->name }}</span>
                            </div>

                            <div class="row">

                                @if ($productsByCategory->count())
                                    @foreach ($productsByCategory as $product)
                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 col-lg-2_4 p-b-20">
                                            <div class="card mx-auto product-card">
                                                <div onclick="location.href='#';" style="cursor: pointer;">
                                                    <div class="text-center">
                                                        <img src={{ asset($product->main_image->path) }}
                                                            class="card-img-top" alt="...">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $product->name }}</h5>

                                                        <div class="mb-3 mt-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="star-ratings" style="font-size: 16px;">
                                                                    <div class="fill-ratings d-flex" style="width: 86%;">
                                                                        <span>★★★★★</span>
                                                                    </div>
                                                                    <div class="empty-ratings">
                                                                        <span>★★★★★</span>
                                                                    </div>
                                                                </div>
                                                                <span class="text-normal ml-2 f-14 mt-1">Đã bán
                                                                    {{ $product->quantity_sold }}</span>
                                                            </div>
                                                        </div>

                                                        <div style="display: flex; align-items: center;">
                                                            <h6 class="mr-2 mb-0 text-danger">
                                                                {{ $product->price }}₫
                                                            </h6>
                                                            @if ($product->sale)
                                                                <h5 class="mr-2 mb-0"
                                                                    style="color: #6c757d; font-size:13px;">
                                                                    <del>{{ ($product->price * (100 + $product->sale)) / 100 }}₫</del>
                                                                </h5>
                                                                <span class="badge badge-danger"
                                                                    style="font-size: 14px;">-{{ $product->sale }}%</span>
                                                            @endif
                                                        </div>

                                                        <div class="text-right mt-3">
                                                            <a href="#" class=" " style="border-radius: 6rem;">
                                                                <i class="fa-solid fa-cart-plus f-30 text-info"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h4 class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">No products
                                        available</h4>
                                @endif

                            </div>
                        </div>

                    @endif --}}



                    @if ($action == 'getAll')
                        @if ($productsData->count())
                            @foreach ($productsData as $category)
                                <div class="prod-by-category">
                                    <div>
                                        <span>{{ $category->name }}</span>
                                    </div>
                                    <div class="row">
                                        @if ($category->products->count())
                                            @foreach ($category->products as $product)
                                                @include('shop.components.product-card', [
                                                    'product' => $product,
                                                ])
                                            @endforeach
                                        @else
                                            <h4 class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">No products
                                                available
                                            </h4>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h4 class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">No products
                                available
                            </h4>
                        @endif
                    @else
                        <div class="prod-by-category">
                            <div>
                                <span>{{ $selectedCategory->name }}</span>
                            </div>
                            <div class="row">
                                @if ($productsByCategory->count())
                                    @foreach ($productsByCategory as $product)
                                        @include('shop.components.product-card', ['product' => $product])
                                    @endforeach
                                @else
                                    <h4 class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">No products available
                                    </h4>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Page-body end -->
    </div>
    {{-- rating star --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var star_rating_width = $('.fill-ratings span').width();
            $('.star-ratings').width(star_rating_width);
        });
    </script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var productRows = document.querySelectorAll('.product-row');

            productRows.forEach(function(productRow) {
                var products = productRow.children;
                var count = products.length;

                var colClass = '';
                if (count === 1) {
                    colClass = 'col-sm-12 col-md-12 col-lg-12 col-xl-12 p-b-30';
                } else if (count === 2) {
                    colClass = 'col-sm-12 col-md-6 col-lg-6 col-xl-6 p-b-30';
                } else if (count === 3) {
                    colClass = 'col-sm-12 col-md-6 col-lg-4 col-xl-4 p-b-30';
                } else {
                    colClass = 'col-sm-6 col-md-4 col-lg-3 col-xl-2 p-b-30';
                }

                Array.from(products).forEach(function(product) {
                    product.className =
                        colClass; // Điều chỉnh cho phù hợp với các breakpoint khác nếu cần
                });
            });
        });
    </script> --}}

    {{-- <script>
        window.addEventListener('resize', adjustProductColumns);
        document.addEventListener('DOMContentLoaded', adjustProductColumns);

        function adjustProductColumns() {
            const products = document.querySelectorAll('.product-card');
            const screenWidth = window.innerWidth;

            products.forEach(product => {
                // Reset class to default for all products
                product.closest('.col-sm-6').classList.remove('col-lg-3', 'col-xl-2');
                product.closest('.col-sm-6').classList.add('col-lg-2_4');
            });

            if (screenWidth >= 1200 && screenWidth <= 1500) {
                products.forEach(product => {
                    // Adjust class for products to show 5 per row
                    product.closest('.col-sm-6').classList.remove('col-lg-3', 'col-xl-2');
                    product.closest('.col-sm-6').classList.add('col-lg-2_4');
                });
            }
        }
    </script> --}}
@endsection
