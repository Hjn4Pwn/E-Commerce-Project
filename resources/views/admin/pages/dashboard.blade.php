@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeDashboard' => 'active'])
    <div class="pcoded-content">
        <!-- Page-header start -->
        @include('admin.components.pageHeader')
        <!-- Page-header end -->
        <div class="pcoded-inner-content">
            <!-- Main-body start -->
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- Page-body start -->
                    <div class="page-body">
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <style>
                            .chart-container {
                                width: 80%;
                                margin: auto;
                            }
                        </style>


                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card text-center">
                                    <div class="card-block">
                                        <div class="chart-container">
                                            <canvas id="monthlySalesChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center align-items-center text-center">
                            <div class="col-xl-8 col-md-12">
                                <div class="card mat-stat-card">
                                    <div class="card-block">
                                        <div class="row align-items-center b-b-default">
                                            <div class="col-sm-6 b-r-default p-b-20 p-t-20">
                                                <div class="row align-items-center text-center">
                                                    <div class="col-4 p-r-0">
                                                        <i class="far fa-user text-c-purple f-24"></i>
                                                    </div>
                                                    <div class="col-8 p-l-0">
                                                        <h5>{{ $data['totalUsers'] }}</h5>
                                                        <p class="text-muted m-b-0">Khách hàng</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 p-b-20 p-t-20">
                                                <div class="row align-items-center text-center">
                                                    <div class="col-4 p-r-0">
                                                        <i class="fa-solid fa-boxes-stacked text-c-green f-24"></i>
                                                    </div>
                                                    <div class="col-8 p-l-0">
                                                        <h5>{{ $data['totalProducts'] }}</h5>
                                                        <p class="text-muted m-b-0">Sản phẩm</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-6 p-b-20 p-t-20 b-r-default">
                                                <div class="row align-items-center text-center">
                                                    <div class="col-4 p-r-0">
                                                        <i class="far fa-file-alt text-c-red f-24"></i>
                                                    </div>
                                                    <div class="col-8 p-l-0">
                                                        <h5>{{ $data['totalOrders'] }}</h5>
                                                        <p class="text-muted m-b-0">Đơn hàng</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 p-b-20 p-t-20">
                                                <div class="row align-items-center text-center">
                                                    <div class="col-4 p-r-0">
                                                        <i class="fa-solid fa-star text-c-yellow f-24"></i>
                                                    </div>
                                                    <div class="col-8 p-l-0">
                                                        <h5>{{ $data['totalReviews'] }}</h5>
                                                        <p class="text-muted m-b-0">Đánh giá</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xl-5 col-md-12">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <h5>Khách hàng thân thiết</h5>
                                        <div class="card-header-right">
                                            Tổng giá trị đã mua
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive">
                                            <table class="table table-hover m-b-0 without-header">
                                                <tbody>
                                                    @foreach ($data['topUsers'] as $user)
                                                        <tr>
                                                            <td>
                                                                <div class="d-inline-block align-middle">
                                                                    @if (!$user['avatar'])
                                                                        <img src={{ asset('AdminResource/images/test/nonAuth.png') }}
                                                                            class="img-radius img-40 align-top m-r-20"
                                                                            alt="User-Profile-Image">
                                                                    @else
                                                                        <img src={{ asset($user['avatar']) }}
                                                                            class="img-radius img-40 align-top m-r-20"
                                                                            alt="User-Profile-Image">
                                                                    @endif

                                                                    <div class="d-inline-block">
                                                                        <h6>{{ $user['user_name'] }}</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-right">
                                                                <h6 class="f-w-700">
                                                                    {{ format_currency($user['total_spent']) }}
                                                                </h6>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-7 col-md-12">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <h5>Sản phẩm bán chạy</h5>
                                        <div class="card-header-right">
                                            Số lượng đã bán
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive">
                                            <table class="table table-hover m-b-0 without-header">
                                                <tbody>
                                                    @foreach ($data['topProducts'] as $product)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src={{ asset($product['main_image']->path) }}
                                                                        class="img-radius img-50 align-top m-r-20"
                                                                        alt="User-Profile-Image">
                                                                    <div class="d-inline-block">
                                                                        <h6>{{ $product['name'] }}</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-right">
                                                                <h6 class="f-w-700">
                                                                    {{ format_to_k($product['quantity_sold']) }}
                                                                </h6>
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
                    </div>
                    <!-- Page-body end -->
                </div>
                <div id="styleSelector"> </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('monthlySalesChart').getContext('2d');
            var monthlySalesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                        'Tháng 7', 'Tháng 8',
                        'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                    ],
                    datasets: [{
                        label: 'Doanh số hàng tháng',
                        data: @json($data['monthlySalesData']),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Dữ liệu doanh số hàng tháng'
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tháng'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Doanh số (Đồng)'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
