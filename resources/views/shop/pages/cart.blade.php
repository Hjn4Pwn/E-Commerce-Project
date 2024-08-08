@extends('shop.layout')

@section('content')
    @include('shop.components.pageHeader', [
        'activeCart' => 'active',
        'categories' => $categories,
    ])

    <div class="pcoded-inner-content no-select">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    @include('shop.components.breadcrumb', [
                        'subpage' => 'Giỏ hàng',
                    ])

                    <div class="row justify-content-center">
                        <div class="col-md-10 bg-white p-5">
                            @if ($cartItems->isEmpty())
                                <div class="text-center">
                                    <img src={{ asset('AdminResource/images/test/empty_cart.png') }}
                                        class="rounded-3 cart-product-image" alt="Product Image" style="width: 300px;" />
                                </div>
                                <p class="text-center f-18 text-info">Giỏ hàng của bạn đang trống.</p>
                            @else
                                <form method="POST" action="{{ route('order.storeTemporary') }}">
                                    @csrf
                                    @foreach ($cartItems as $item)
                                        <div class="row align-items-center product-bottom-line" style="height: 150px;">
                                            <div class="col-3 col-md-2"
                                                onclick="location.href='{{ route('shop.products.productDetails', ['product' => $item['product']->id]) }}';"
                                                style="cursor: pointer;">
                                                <img src="{{ Storage::disk('s3')->url($item['product']->main_image->path) }}"
                                                    class="rounded-3 cart-product-image" alt="Product Image" />
                                            </div>
                                            <div class="col-9 col-md-10">
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div>
                                                            <div class="cart-product-name"
                                                                onclick="location.href='{{ route('shop.products.productDetails', ['product' => $item['product']->id]) }}';"
                                                                style="cursor: pointer;">
                                                                {{ $item['product']->name }}
                                                            </div>
                                                            <div class="cart-flavor">
                                                                {{ $item['flavor']->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-md-6 d-flex align-items-center justify-content-between">
                                                        <h5 class="text-info mr-2 product-price">
                                                            {{ format_currency($item['product']->price) }}
                                                        </h5>
                                                        <input type="number" class="text-center mr-2 product-quantity"
                                                            style="width: 100px;"
                                                            name="items[{{ $loop->index }}][quantity]"
                                                            value="{{ $item['quantity'] }}" min="1"
                                                            data-price="{{ $item['product']->price }}"
                                                            data-max="{{ $item['available_quantity'] }}">
                                                        <input type="hidden" name="items[{{ $loop->index }}][product_id]"
                                                            value="{{ $item['product']->id }}">
                                                        <input type="hidden" name="items[{{ $loop->index }}][flavor_id]"
                                                            value="{{ $item['flavor']->id }}">
                                                        <!-- Button to trigger JavaScript function for deletion -->
                                                        <button type="button"
                                                            class="btn btn-danger waves-effect waves-light"
                                                            onclick="confirmDelete('{{ $item['product']->id }}', '{{ $item['flavor']->id }}')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="mb-3 mt-5" style="height: 150px;">
                                        <div class="f-18 text-info font-weight-bold">Ghi chú đơn hàng:</div>
                                        <div class="mt-2">
                                            <textarea class="form-control" name="note" rows="3" placeholder="Nhập ghi chú của bạn tại đây..."></textarea>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center" style="line-height: 24px;">
                                        <div class="f-16 mr-2">Tổng thanh toán:</div>
                                        <div class="f-24 text-info font-weight-bold" id="total-payment">
                                            0₫</div>
                                        <input type="hidden" name="total_price" id="total_price">
                                        <button type="submit" class="btn btn-info ml-3">Đặt hàng</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-5"></div>
    </div>

    <script>
        function formatCurrency(amount) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(amount);
        }

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.product-quantity').forEach(function(input) {
                const price = input.getAttribute('data-price');
                const quantity = input.value;
                total += price * quantity;
            });
            document.getElementById('total-payment').textContent = formatCurrency(total);
            document.getElementById('total_price').value = total; // Cập nhật giá trị của trường ẩn
        }

        document.querySelectorAll('.product-quantity').forEach(function(input) {
            input.addEventListener('input', function() {
                const maxQuantity = parseInt(this.getAttribute('data-max'));
                if (parseInt(this.value) > maxQuantity) {
                    this.value = maxQuantity;
                }
                calculateTotal();
            });
        });

        calculateTotal();

        function confirmDelete(productId, flavorId) {
            if (confirm('Bạn có chắc rằng muốn xóa sản phẩm này khỏi giỏ hàng của mình?')) {
                // Create form and submit to delete product
                var form = document.createElement('form');
                form.method = 'post';
                form.action = '{{ route('cart.removeItem') }}';

                var csrfField = document.createElement('input');
                csrfField.type = 'hidden';
                csrfField.name = '_token';
                csrfField.value = '{{ csrf_token() }}';
                form.appendChild(csrfField);

                var productIdField = document.createElement('input');
                productIdField.type = 'hidden';
                productIdField.name = 'product_id';
                productIdField.value = productId;
                form.appendChild(productIdField);

                var flavorIdField = document.createElement('input');
                flavorIdField.type = 'hidden';
                flavorIdField.name = 'flavor_id';
                flavorIdField.value = flavorId;
                form.appendChild(flavorIdField);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
