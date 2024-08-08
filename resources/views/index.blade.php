@extends('shop.layout')

@section('content')
    {{-- @include('shop.components.navbar') --}}
    @include('shop.components.pageHeader', [
        'activeHome' => 'active',
        'categories' => $categories,
        'search' => $search,
    ])

    <div class="pcoded-inner-content no-select">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- slider --}}
                    @include('shop.components.slider', ['sliders' => $sliders])
                    {{-- ---- --}}

                    @if ($action == 'getAll')
                        @if ($search)
                            <div class="row">
                                @if ($productsData && count($productsData) > 0)
                                    @foreach ($productsData as $product)
                                        @include('shop.components.product-card', [
                                            'product' => $product,
                                            'isOutOfStock' => $outOfStockProducts->contains($product->id),
                                        ])
                                    @endforeach
                                @else
                                    <h4 class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">Không có sản phẩm.
                                    </h4>
                                @endif
                            </div>
                        @elseif ($productsData)
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
                                                    'isOutOfStock' => $outOfStockProducts->contains($product->id),
                                                ])
                                            @endforeach
                                        @else
                                            <h4 class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">Không có sản
                                                phẩm.
                                            </h4>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h4 class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">Không có sản phẩm.
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
                                        @include('shop.components.product-card', [
                                            'product' => $product,
                                            'isOutOfStock' => $outOfStockProducts->contains($product->id),
                                        ])
                                    @endforeach
                                @else
                                    <h4 class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">Không có sản phẩm.
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

@endsection
