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
                                        <h5>User Information</h5>
                                    </div>
                                    <div class="card-block">
                                        <form>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Name</label>
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
                                                <label class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control"
                                                        value="{{ $order->user->phone }}" readonly>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Payment</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="1908736495"
                                                        readonly>
                                                </div>
                                            </div> --}}
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <div class="form-control-static text-info pt-2">{{ $order->address }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Note</label>
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
                                        <h5>User Orders</h5>
                                        {{-- <span>use class <code>table-hover</code> inside table element</span> --}}
                                        <div class="card-header-right">
                                            {{-- <ul class="list-unstyled card-option">
                                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                    <li><i class="fa fa-refresh reload-card"></i></li>
                                    <li><i class="fa fa-trash close-card"></i></li>
                                </ul> --}}
                                        </div>
                                    </div>
                                    <div class="card-block table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th width=35%>Name </th>
                                                        <th class="text-center" width=25%>Image</th>
                                                        <th class="text-center" width=10%>Quantity</th>
                                                        <th class="text-center" width=30%>Price</th>
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
                                                                    src={{ asset($item->product->mainImage->path) }}
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
                                        <h5>Invoice</h5>
                                    </div>
                                    <div class="card-block">
                                        <form>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Subtotal</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"
                                                        value="{{ format_currency($order->total_price) }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Ship</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"
                                                        value="{{ format_currency($order->shipping_fee) }}" readonly>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label form-bg-primary">Total</label>
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
