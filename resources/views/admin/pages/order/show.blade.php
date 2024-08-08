@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeOrders' => 'active'])
    <div class="pcoded-content">
        <!-- Page-header start -->
        @include('admin.components.pageHeader', [
            'parentPage' => $parentPage,
            'childPage' => $childPage,
        ])
        <!-- Page-header end -->
        <div class="pcoded-inner-content">
            <!-- Main-body start -->
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- Page-body start -->
                    <div class="page-body">

                        <div class="row p-b-20">
                            <div class="col-sm-4">
                                <div class="row">

                                    <div class="col-sm-4">
                                        <span class="" style ="font-size: 18px;">
                                            Trạng thái:
                                        </span>
                                    </div>
                                    <div class="col-sm-8">
                                        @if (in_array($order->status, ['pending', 'processing']))
                                            <span class="bg-secondary text-white"
                                                style ="font-size: 20px; padding: 10px; border-radius: 2px;">
                                                Đang chuẩn bị hàng
                                            </span>
                                        @elseif ($order->status == 'shipped')
                                            <span class="bg-primary text-white"
                                                style ="font-size: 20px; padding: 10px; border-radius: 2px;">
                                                Đang vận chuyển
                                            </span>
                                        @elseif ($order->status == 'delivered')
                                            <span class="bg-success text-white"
                                                style ="font-size: 20px; padding: 10px; border-radius: 2px;">
                                                Giao hàng thành công
                                            </span>
                                        @elseif ($order->status == 'cancelled')
                                            <span class="bg-danger text-white"
                                                style ="font-size: 20px; padding: 10px; border-radius: 2px;">
                                                Đã hủy
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">

                            <div class="col-sm-5">
                                <!-- Basic Form Inputs card start -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Thông tin khách hàng</h5>
                                    </div>
                                    <div class="card-block">
                                        <form>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tên</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control"
                                                        value="{{ $order->user->name }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control"
                                                        value="{{ $order->user->email }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control"
                                                        value="{{ $order->user->phone }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Địa chỉ</label>
                                                <div class="col-sm-9">
                                                    <div class="form-control-static text-info pt-2">{{ $order->address }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Ghi chú</label>
                                                <div class="col-sm-9">
                                                    <div class="form-control-static text-muted pt-2">
                                                        {{ $order->note }}
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Basic Form Inputs card end -->
                            </div>

                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Chi tiết đơn hàng</h5>
                                        <div class="card-header-right">

                                        </div>
                                    </div>
                                    <div class="card-block table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th width=35%>Tên </th>
                                                        <th class="text-center" width=25%>Ảnh</th>
                                                        <th class="text-center" width=10%>Số lượng</th>
                                                        <th class="text-center" width=30%>Giá</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 0;
                                                    @endphp
                                                    @foreach ($order->items as $item)
                                                        <tr>
                                                            <th class="" scope="row">{{ ++$i }}</th>
                                                            <td class="">{{ $item->product->name }}
                                                            </td>
                                                            <td class="text-center p-t-5"><img
                                                                    src={{ Storage::disk('s3')->url($item->product->main_image->path) }}
                                                                    class="rounded-3" style="width: 100px; "
                                                                    alt="Product Image" /></td>
                                                            <td class=" text-center">{{ $item->quantity }}</td>
                                                            <td class=" text-center">
                                                                {{ format_currency($item->product->price) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-6">
                                <!-- Basic Form Inputs card start -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Đơn giá</h5>
                                    </div>
                                    <div class="card-block">
                                        <form>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Tạm tính</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"
                                                        value="{{ format_currency($order->total_price) }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Phí vận chuyển</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"
                                                        value="{{ format_currency($order->shipping_fee) }}" readonly>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label form-bg-primary">Tổng giá trị</label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-static text-success"
                                                        style="font-size: 26px; font-weight: bold;">
                                                        {{ format_currency($order->shipping_fee + $order->total_price) }}
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                        <div class="float-right">
                                            <form action="{{ route('orders.ship', Crypt::encrypt($order->id)) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" data-order-status="{{ $order->status }}"
                                                    class="btn btn-success waves-effect waves-light mr-2 ship-button">Ship</button>
                                            </form>
                                            <form action="{{ route('orders.admin_cancel', Crypt::encrypt($order->id)) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" data-order-status="{{ $order->status }}"
                                                    class="btn btn-danger waves-effect waves-light cancel-button">Hủy</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                                <!-- Basic Form Inputs card end -->
                            </div>
                        </div>
                    </div>
                    <!-- Page-body end -->
                </div>
                <div id="styleSelector"> </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.ship-button, .cancel-button');

            buttons.forEach(button => {
                const orderStatus = button.getAttribute('data-order-status');
                const isAccessable = ['pending', 'processing'].includes(orderStatus);

                if (button.classList.contains('ship-button') && !isAccessable) {
                    button.disabled = true;
                    button.classList.remove('btn-success');
                    button.classList.add('btn-secondary');
                    button.style.cursor = 'not-allowed';
                } else if (button.classList.contains('cancel-button') && !isAccessable) {
                    button.disabled = true;
                    button.classList.remove('btn-danger');
                    button.classList.add('btn-secondary');
                    button.style.cursor = 'not-allowed';
                }
            });
        });
    </script>
@endsection
