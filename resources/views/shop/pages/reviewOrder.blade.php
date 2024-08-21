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
                    <div class="row justify-content-center">
                        <div class="col-md-10 bg-white p-5">
                            <h3 class="text-center">Xác nhận Đơn hàng</h3>

                            <div class="mt-2">
                                <span class="f-16 text-info">Địa chỉ giao hàng: </span>
                                <span>{{ session('address') ?? session('original_address') }}</span>
                                <a href="#" class="text-danger link_none" data-toggle="modal"
                                    data-target="#changeAddressModal">Thay đổi</a>
                            </div>

                            <div class="mb-3">
                                <span class="f-16 text-info">Số điện thoại: </span>
                                <span>{{ session('phone') ?? session('original_phone') }}</span>
                                <a href="#" class="text-danger link_none" data-toggle="modal"
                                    data-target="#changePhoneModal">Thay đổi</a>
                            </div>
                            @php
                                $ship = session('shipping_fee');
                            @endphp
                            <div class="mb-3 d-flex justify-content-end align-items-center">
                                <span class="f-16">Phí vận chuyển: </span>
                                <span class="text-info f-24 font-weight-bold ml-2">{{ format_currency($ship) }}</span>
                            </div>

                            <!-- Order Review Section -->
                            @if ($OrderReview)
                                @php
                                    $total_price = 0;
                                @endphp
                                @foreach ($OrderReview as $item)
                                    <div class="row align-items-center product-bottom-line" style="height: 150px;">
                                        <div class="col-3 col-md-2">
                                            <img src="{{ Storage::disk('s3')->url($item['main_image']) }}"
                                                class="rounded-3 cart-product-image" alt="Product Image" />
                                        </div>
                                        <div class="col-9 col-md-10">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div>
                                                        <div class="cart-product-name">{{ $item['product_name'] }}</div>
                                                        <div class="cart-flavor">{{ $item['flavor_name'] }}</div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-12 col-md-6 d-flex align-items-center justify-content-between">
                                                    <h5 class="text-info mr-2 product-price">
                                                        {{ format_currency($item['price']) }}</h5>
                                                    <div class="product-quantity mr-5">{{ $item['quantity'] }}</div>
                                                    @php
                                                        $total_price += $item['price'] * $item['quantity'];
                                                    @endphp
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Note Section -->
                                @if ($note)
                                    <div class="mb-3 mt-5">
                                        <div class="f-18 text-info font-weight-bold">Ghi chú đơn hàng:</div>
                                        <div class="mt-2">{{ $note }}</div>
                                    </div>
                                @endif



                                <form method="POST" action="{{ route('order.confirmOrder') }}">
                                    @csrf
                                    <!-- Payment Method Section -->
                                    <div class="mb-3 mt-5">
                                        <div class="f-18 text-info font-weight-bold">Chọn hình thức thanh toán:</div>
                                        <div class="mt-2 ml-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    id="payment_method1" value="cash_on_delivery" checked>
                                                <label class="form-check-label" for="payment_method1">Thanh toán khi nhận
                                                    hàng</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    id="payment_method2" value="online_payment">
                                                <label class="form-check-label" for="payment_method2">Thanh toán
                                                    online</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Total Price and Submit Button -->
                                    <div class="d-flex justify-content-end align-items-center">
                                        <div class="f-16 mr-2">Tổng thanh toán:</div>
                                        <div class="f-24 text-info font-weight-bold" id="total-payment">
                                            {{ format_currency($total_price + $ship) }}</div>

                                        <button type="submit" class="btn btn-info ml-3">Xác nhận đặt hàng</button>
                                    </div>
                                </form>
                            @else
                                <p class="text-center f-18 text-info">Giỏ hàng của bạn đang trống.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Address Modal -->
    <div class="modal fade" id="changeAddressModal" tabindex="-1" aria-labelledby="changeAddressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeAddressModalLabel">Thay đổi Địa chỉ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('updateAddress') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="province">Tỉnh/Thành phố</label>
                            <div class="">
                                @if ($provinces->count())
                                    <select id="provinceSelect" name="province" class="form-control select2-format "
                                        style="width:100%;">
                                        @if (!$user->province)
                                            <option value="">Chọn Tỉnh/Thành phố</option>
                                        @else
                                            <option value="{{ $user->province->code }}">
                                                {{ $user->province->name }}</option>
                                        @endif
                                        @foreach ($provinces as $province)
                                            <option value={{ $province->code }}>
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="district">Quận/Huyện</label>
                            <div class="">
                                <select id="districtSelect" name="district" class="form-control select2-format"
                                    style="width:100%;">
                                    @if (!$user->district)
                                        <option value="">Chọn Quận/Huyện</option>
                                    @else
                                        <option value="{{ $user->district->code }}">
                                            {{ $user->district->name }}</option>
                                    @endif
                                    {{--  --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ward">Phường/Xã</label>
                            <div class="">
                                <select id="wardSelect" name="ward" class="form-control select2-format"
                                    style="width:100%;">
                                    @if (!$user->ward)
                                        <option value="">Chọn Phường/Xã</option>
                                    @else
                                        <option value="{{ $user->ward->code }}">
                                            {{ $user->ward->name }}</option>
                                    @endif
                                    {{--  --}}
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="addressDetail">Địa chỉ cụ thể</label>
                            <div class="">
                                <input type="text" class="form-control" name="address_detail"
                                    value="{{ $user->address_detail }}">
                            </div>
                        </div>
                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Phone Modal -->
    <div class="modal fade" id="changePhoneModal" tabindex="-1" aria-labelledby="changePhoneModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePhoneModalLabel">Thay đổi Số điện thoại</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('updatePhone') }}">
                    @csrf
                    <div class="modal-body">
                        <!-- Phone Form Field -->
                        <div class="form-group">
                            <label for="phone">Số điện thoại mới</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="{{ $user->phone }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- render Provinces, Districts, Wards --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- get Districts By Province Id --}}
    <script>
        $(document).ready(function() {
            $('#provinceSelect').on('change', function() {
                var provinceId = $(this).val();
                if (provinceId) {
                    $.ajax({
                        url: '/getDistricts/' + provinceId,
                        type: 'GET',
                        timeout: 5000,
                        success: function(data) {
                            $('#districtSelect').html(data);
                            // $('#districtSelect').select2();
                        },
                        error: function(xhr, status, error) {
                            console.error("Failed to fetch districts: " + error);
                            alert("Could not fetch data. Please try again later.");
                        }
                    });
                } else {
                    $('#districtSelect').html('<option value="">Chọn Quận/Huyện</option>');
                }
            });
        });
    </script>

    {{-- get Wards By District Id --}}
    <script>
        $(document).ready(function() {
            $('#districtSelect').on('change', function() {
                var districtId = $(this).val();
                if (districtId) {
                    $.ajax({
                        url: '/getWards/' + districtId,
                        type: 'GET',
                        timeout: 5000,
                        success: function(data) {
                            $('#wardSelect').html(data);
                            // $('#wardSelect').select2();
                        },
                        error: function(xhr, status, error) {
                            console.error("Failed to fetch wards: " + error);
                            alert("Could not fetch data. Please try again later.");
                        }
                    });
                } else {
                    $('#wardSelect').html('<option value="">Chọn Phường/Xã</option>');
                }
            });
        });
    </script>
@endsection
