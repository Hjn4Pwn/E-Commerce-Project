@extends('shop.layout')

@section('content')
    @include('shop.components.pageHeader', [
        'activeOrder' => 'active',
        'categories' => $categories,
    ])

    <div class="pcoded-inner-content no-select">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">

                    @if ($orders->isEmpty())
                        <div class="mt-5">
                            <div class="text-center">
                                <img src={{ asset('AdminResource/images/test/empty_cart.png') }}
                                    class="rounded-3 cart-product-image" alt="Product Image" style="width: 300px;" />
                            </div>
                            <p class="text-center f-18 text-info">Hiện tại bạn chưa có đơn hàng nào.</p>
                        </div>
                    @else
                        @foreach ($orders as $order)
                            <div class="row justify-content-center">
                                <div class="col-md-10 bg-white p-3 order-box">
                                    <div class="d-flex justify-content-end align-items-center">
                                        @if (in_array($order['order_id'], $invalidOrderIds))
                                            <span class="f-18 text-purple font-weight-bold">Không hợp lệ</span>
                                        @else
                                            @if (in_array($order['status'], ['pending', 'processing']))
                                                <span class="f-18 text-dark font-weight-bold">Đang chuẩn bị
                                                    hàng</span>
                                            @elseif ($order['status'] == 'shipped')
                                                <span class="f-18 text-primary font-weight-bold">Đang vận chuyển</span>
                                            @elseif ($order['status'] == 'delivered')
                                                <span class="f-18 text-success font-weight-bold">Giao hàng thành công</span>
                                            @elseif ($order['status'] == 'cancelled')
                                                <span class="f-18 text-danger font-weight-bold">Đã hủy</span>
                                            @endif
                                        @endif
                                    </div>

                                    <div class="">
                                        <div class="">
                                            <span class="f-16 text-info">Địa chỉ: </span>
                                            <span>{{ $order['address'] }}</span>
                                        </div>

                                        <div class="mb-3">
                                            <span class="f-16 text-info">SĐT: </span>
                                            <span>{{ $order['phone'] }}</span>
                                        </div>
                                    </div>

                                    @foreach ($order['items'] as $item)
                                        <div class="row align-items-center product-bottom-line" style="height: 150px;">
                                            <div class="col-3 col-md-2">
                                                <img src="{{ optional($item['product']) && optional($item['product'])->main_image ? Storage::disk('s3')->url(optional($item['product'])->main_image->path) : null }}"
                                                    class="rounded-3 cart-product-image" alt="Product Image" />
                                            </div>
                                            <div class="col-9 col-md-10">
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div>
                                                            <div class="cart-product-name">
                                                                {{ optional($item['product'])->name ?? 'Unknown Product' }}
                                                            </div>
                                                            <div class="cart-flavor">
                                                                {{ optional($item['flavor'])->name ?? 'unflavored' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-md-6 d-flex align-items-center justify-content-between">
                                                        <h5 class="text-info mr-2 product-price">
                                                            {{ format_currency(optional($item['product'])->price ?? 0) }}
                                                        </h5>
                                                        <div class="product-quantity mr-5">
                                                            {{ $item['quantity'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="d-flex flex-column align-items-end mt-2">

                                        <div class="d-flex justify-content-end align-items-center mb-2">
                                            <span class="f-16">Phí vận chuyển: </span>
                                            <span
                                                class="text-info f-18 ml-2">{{ format_currency($order['shipping_fee']) }}</span>
                                        </div>

                                        <div class="d-flex justify-content-end align-items-center mb-2">
                                            @if ($order['payment_method'] == 'online_payment' && !in_array($order['order_id'], $invalidOrderIds))
                                                <span class="f-18 text-success font-weight-bold">Đã thanh toán</span>
                                            @endif
                                            <div class="f-16 mr-2 ml-2">Thành tiền:</div>
                                            <div class="f-20 text-info font-weight-bold" id="total-payment">
                                                {{ format_currency($order['total_price'] + $order['shipping_fee']) }}
                                            </div>
                                        </div>

                                        <div class="order-buttons d-flex flex-column flex-md-row">


                                            @if (!in_array($order['order_id'], $invalidOrderIds))
                                                <form
                                                    action="{{ route('orders.confirmReceipt', encrypt($order['order_id'])) }}"
                                                    method="POST" class="mb-2 mb-md-0">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-success mr-md-3 confirm-receipt-button"
                                                        data-order-status="{{ $order['status'] }}"
                                                        id="confirm-receipt-button-{{ $order['order_id'] }}">Đã nhận được
                                                        hàng</button>
                                                </form>

                                                <form action="{{ route('orders.cancel', encrypt($order['order_id'])) }}"
                                                    method="POST" class="mb-2 mb-md-0">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger cancel-button"
                                                        data-order-status="{{ $order['status'] }}"
                                                        id="cancel-button-{{ $order['order_id'] }}">Hủy đơn</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cancelButtons = document.querySelectorAll('.cancel-button');
            cancelButtons.forEach(button => {
                const orderStatus = button.getAttribute('data-order-status');
                if (!['pending', 'processing'].includes(orderStatus)) {
                    button.disabled = true;
                    button.classList.remove('btn-info');
                    button.classList.add('btn-secondary');
                }
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const confirmReceiptButtons = document.querySelectorAll('.confirm-receipt-button');
            confirmReceiptButtons.forEach(button => {
                const orderStatus = button.getAttribute('data-order-status');
                if (orderStatus !== 'shipped') {
                    button.disabled = true;
                    button.classList.remove('btn-success');
                    button.classList.add('btn-secondary');
                    button.style.cursor = 'not-allowed';
                }
            });

            const cancelButtons = document.querySelectorAll('.cancel-button');
            cancelButtons.forEach(button => {
                const orderStatus = button.getAttribute('data-order-status');
                if (!['pending', 'processing'].includes(orderStatus)) {
                    button.disabled = true;
                    button.classList.remove('btn-danger');
                    button.classList.add('btn-secondary');
                    button.style.cursor = 'not-allowed';
                }
            });
        });
    </script>
@endsection
