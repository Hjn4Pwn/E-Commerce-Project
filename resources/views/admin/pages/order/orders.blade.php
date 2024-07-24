@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeOrders' => 'active'])
    <div class="pcoded-content">
        <!-- Page-header start -->
        @include('admin.components.pageHeader', ['page' => $page])
        <!-- Page-header end -->
        <div class="pcoded-inner-content">
            <!-- Main-body start -->
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- Page-body start -->
                    <div class="page-body">
                        <div class="card">
                            <div class="card-header">
                                <h5>List of Orders</h5>
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
                                    <div class="p-15 p-b-0">
                                        <form class="form-material">
                                            <div class="form-group form-primary">
                                                <input type="text" name="footer-email" class="form-control">
                                                <span class="form-bar"></span>
                                                <label class="float-label"><i class="fa fa-search m-r-10"></i>Search
                                                    by Name</label>
                                            </div>
                                        </form>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Address</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($orders->count())
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <th class="lh40" scope="row">{{ ++$i }}</th>
                                                        <td class="lh40 text-center">{{ $order->user->name }}</td>
                                                        <td class="lh40 text-center">{{ $order->address }}</td>
                                                        <td class="lh40 text-center">
                                                            {{ format_date_to_ho_chi_minh_timezone($order->created_at) }}
                                                        </td>
                                                        <td class="lh40 text-center">
                                                            {{ format_currency($order->total_price + $order->shipping_fee) }}
                                                        </td>

                                                        @if (in_array($order->status, ['pending', 'processing']))
                                                            <td class="lh40 text-center text-dark font-weight-bold">
                                                                Đang chuẩn bị hàng
                                                            </td>
                                                        @elseif ($order->status == 'shipped')
                                                            <td class="lh40 text-center text-primary font-weight-bold">
                                                                Đang giao hàng
                                                            </td>
                                                        @elseif ($order->status == 'delivered')
                                                            <td class="lh40 text-center text-success font-weight-bold">
                                                                Giao hàng thành công
                                                            </td>
                                                        @elseif ($order->status == 'cancelled')
                                                            <td class="lh40 text-center text-danger font-weight-bold">
                                                                Đã hủy
                                                            </td>
                                                        @endif
                                                        <td class="text-center">
                                                            <a href="{{ route('admin.viewOrder', Crypt::encrypt($order->id)) }}"
                                                                class="btn btn-info waves-effect waves-light">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                            {{-- <a href=""
                                                                class="btn btn-danger waves-effect waves-light">
                                                                <i class="fa fa-trash"></i>
                                                            </a> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center text-info">
                                                        No orders available
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page-body end -->
                </div>
                <div id="styleSelector"> </div>
            </div>
        </div>
    </div>
@endsection
