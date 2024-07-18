<div class="col-sm-6 col-md-4 col-lg-2_4 col-xl-2 p-b-20">
    <div class="card mx-auto product-card {{ $isOutOfStock ? 'out-of-stock' : '' }}" style="position: relative;">
        <div onclick="location.href='{{ route('shop.products.productDetails', ['product' => $product->id]) }}';"
            style="cursor: pointer;">
            <div class="text-center">
                <img src="{{ asset($product->main_image->path) }}" class="card-img-top" alt="...">
                @if ($isOutOfStock)
                    <div class="out-of-stock-overlay">
                        <span class="out-of-stock-text">Hết hàng</span>
                    </div>
                @endif
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
                        <span class="text-normal ml-2 f-14 mt-1">Đã bán {{ $product->quantity_sold }}</span>
                    </div>
                </div>

                <div style="display: flex; align-items: center;">
                    <h6 class="mr-1 mb-0 text-danger">{{ format_currency($product->price) }}</h6>
                    @if ($product->sale)
                        <h5 class="mr-1 mb-0" style="color: #6c757d; font-size:12px;">
                            <del>{{ format_currency(($product->price * (100 + $product->sale)) / 100) }}</del>
                        </h5>
                        <span class="badge badge-danger" style="font-size: 13px;">-{{ $product->sale }}%</span>
                    @endif
                </div>

                {{-- <div class="text-right mt-3">
                    <a href="#" class=" " style="border-radius: 6rem;">
                        <i class="fa-solid fa-cart-plus f-30 text-info"></i>
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
</div>
