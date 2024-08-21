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
                                <h5>Danh sách các đơn hàng</h5>
                                {{-- <span>use class <code>table-hover</code> inside table element</span> --}}
                                <div class="card-header-right">

                                </div>
                            </div>
                            <div class="card-block table-border-style">
                                <div class="table-responsive">
                                    <div class="p-15 p-b-0">
                                        <form action="{{ route('admin.orders.index') }}" method="GET"
                                            class="form-material mt-2">
                                            <div class="form-group form-primary form-search">
                                                <input type="text" name="search" class="form-control"
                                                    value="{{ request('search') }}" placeholder=" ">
                                                <span class="form-bar"></span>
                                                <label class="float-label"><i class="fa fa-search m-r-10"></i>Tìm kiếm bằng
                                                    tên</label>
                                            </div>
                                        </form>
                                    </div>


                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center">Tên</th>
                                                <th class="text-center">Địa chỉ</th>
                                                <th class="text-center">Ngày đặt hàng</th>
                                                <th class="text-center">Tổng giá trị</th>
                                                <th class="text-center">Trạng thái</th>
                                                <th class="text-center">Hành động</th>
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
                                                        @if (in_array($order->id, $invalidOrderIds))
                                                            <td class="lh40 text-center text-purple font-weight-bold">
                                                                Không hợp lệ
                                                            </td>
                                                        @else
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
                                                        Chưa có đơn hàng nào.
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
