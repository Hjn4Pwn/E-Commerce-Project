@extends('user.layout')

@section('content')
    {{-- @include('user.components.navbar') --}}
    @include('user.components.pageHeader')

    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    {{-- slider --}}
                    @include('user.components.slider')
                    {{-- ---- --}}
                    <div class="prod-by-category">
                        <div>
                            <span>Creatine</span>
                        </div>

                        <div class="row product-row">
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div onclick="location.href='#';" style="cursor: pointer;">
                                        <div class="text-center">
                                            <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                                class="card-img-top" alt="...">
                                        </div>
                                        <div class="card-body">

                                            <h5 class="card-title">Ostrovit Creatine Monohydrate 500g</h5>
                                            {{-- <p class="card-text">Some quick example text to build on the card title and make
                                                up
                                                the bulk of the card's content.</p> --}}

                                            <div class="mb-3 mt-3">
                                                {{-- <div class="star-rating">
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-regular fa-star text-warning"></i>
                                                        <span class="text-info">(Xem 4 đánh giá)</span>
                                                    </div> --}}
                                                <div class="d-flex align-items-center">
                                                    <div class="star-ratings" style="font-size: 22px;">
                                                        <div class="fill-ratings d-flex" style="width: 86%;">
                                                            <!-- Giả sử muốn hiển thị 4.3 sao, set width là 86% -->
                                                            <span>★★★★★</span>
                                                        </div>
                                                        <div class="empty-ratings ">
                                                            <span>★★★★★</span>
                                                        </div>
                                                    </div>

                                                    <span class="text-normal ml-3 f-14 mt-1">Đã bán 127</span>

                                                </div>
                                            </div>

                                            <div style="display: flex; align-items: center;">
                                                <h5 class="mr-3 mb-0 text-danger">590.000₫</h5>
                                                <h5 class="mr-3 mb-0" style="color: #6c757d; font-size:15px;">
                                                    <del>737.500₫</del>
                                                </h5>
                                                <span class="badge badge-danger" style="font-size: 16px;">-20%</span>
                                            </div>

                                            <div class="text-right mt-3">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div onclick="location.href='#';" style="cursor: pointer;">
                                        <div class="text-center">
                                            <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                                class="card-img-top" alt="...">
                                        </div>
                                        <div class="card-body">

                                            <h5 class="card-title">Ostrovit Creatine Monohydrate 500g</h5>
                                            {{-- <p class="card-text">Some quick example text to build on the card title and make
                                                up
                                                the bulk of the card's content.</p> --}}

                                            <div class="mb-3 mt-3">
                                                {{-- <div class="star-rating">
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-regular fa-star text-warning"></i>
                                                        <span class="text-info">(Xem 4 đánh giá)</span>
                                                    </div> --}}
                                                <div class="d-flex align-items-center">
                                                    <div class="star-ratings" style="font-size: 22px;">
                                                        <div class="fill-ratings d-flex" style="width: 86%;">
                                                            <!-- Giả sử muốn hiển thị 4.3 sao, set width là 86% -->
                                                            <span>★★★★★</span>
                                                        </div>
                                                        <div class="empty-ratings ">
                                                            <span>★★★★★</span>
                                                        </div>
                                                    </div>

                                                    <span class="text-normal ml-3 f-14 mt-1">Đã bán 127</span>

                                                </div>
                                            </div>

                                            <div style="display: flex; align-items: center;">
                                                <h5 class="mr-3 mb-0 text-danger">590.000₫</h5>
                                                <h5 class="mr-3 mb-0" style="color: #6c757d; font-size:15px;">
                                                    <del>737.500₫</del>
                                                </h5>
                                                <span class="badge badge-danger" style="font-size: 16px;">-20%</span>
                                            </div>

                                            <div class="text-right mt-3">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div onclick="location.href='#';" style="cursor: pointer;">
                                        <div class="text-center">
                                            <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                                class="card-img-top" alt="...">
                                        </div>
                                        <div class="card-body">

                                            <h5 class="card-title">Ostrovit Creatine Monohydrate 500g</h5>
                                            {{-- <p class="card-text">Some quick example text to build on the card title and make
                                                up
                                                the bulk of the card's content.</p> --}}

                                            <div class="mb-3 mt-3">
                                                {{-- <div class="star-rating">
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-regular fa-star text-warning"></i>
                                                        <span class="text-info">(Xem 4 đánh giá)</span>
                                                    </div> --}}
                                                <div class="d-flex align-items-center">
                                                    <div class="star-ratings" style="font-size: 22px;">
                                                        <div class="fill-ratings d-flex" style="width: 86%;">
                                                            <!-- Giả sử muốn hiển thị 4.3 sao, set width là 86% -->
                                                            <span>★★★★★</span>
                                                        </div>
                                                        <div class="empty-ratings ">
                                                            <span>★★★★★</span>
                                                        </div>
                                                    </div>

                                                    <span class="text-normal ml-3 f-14 mt-1">Đã bán 127</span>

                                                </div>
                                            </div>

                                            <div style="display: flex; align-items: center;">
                                                <h5 class="mr-3 mb-0 text-danger">590.000₫</h5>
                                                <h5 class="mr-3 mb-0" style="color: #6c757d; font-size:15px;">
                                                    <del>737.500₫</del>
                                                </h5>
                                                <span class="badge badge-danger" style="font-size: 16px;">-20%</span>
                                            </div>

                                            <div class="text-right mt-3">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div onclick="location.href='#';" style="cursor: pointer;">
                                        <div class="text-center">
                                            <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                                class="card-img-top" alt="...">
                                        </div>
                                        <div class="card-body">

                                            <h5 class="card-title">Ostrovit Creatine Monohydrate 500g</h5>
                                            {{-- <p class="card-text">Some quick example text to build on the card title and make
                                                up
                                                the bulk of the card's content.</p> --}}

                                            <div class="mb-3 mt-3">
                                                {{-- <div class="star-rating">
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-regular fa-star text-warning"></i>
                                                        <span class="text-info">(Xem 4 đánh giá)</span>
                                                    </div> --}}
                                                <div class="d-flex align-items-center">
                                                    <div class="star-ratings" style="font-size: 22px;">
                                                        <div class="fill-ratings d-flex" style="width: 86%;">
                                                            <!-- Giả sử muốn hiển thị 4.3 sao, set width là 86% -->
                                                            <span>★★★★★</span>
                                                        </div>
                                                        <div class="empty-ratings ">
                                                            <span>★★★★★</span>
                                                        </div>
                                                    </div>

                                                    <span class="text-normal ml-3 f-14 mt-1">Đã bán 127</span>

                                                </div>
                                            </div>

                                            <div style="display: flex; align-items: center;">
                                                <h5 class="mr-3 mb-0 text-danger">590.000₫</h5>
                                                <h5 class="mr-3 mb-0" style="color: #6c757d; font-size:15px;">
                                                    <del>737.500₫</del>
                                                </h5>
                                                <span class="badge badge-danger" style="font-size: 16px;">-20%</span>
                                            </div>

                                            <div class="text-right mt-3">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div onclick="location.href='#';" style="cursor: pointer;">
                                        <div class="text-center">
                                            <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                                class="card-img-top" alt="...">
                                        </div>
                                        <div class="card-body">

                                            <h5 class="card-title">Ostrovit Creatine Monohydrate 500g</h5>
                                            {{-- <p class="card-text">Some quick example text to build on the card title and make
                                                up
                                                the bulk of the card's content.</p> --}}

                                            <div class="mb-3 mt-3">
                                                {{-- <div class="star-rating">
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                        <i class="fa-regular fa-star text-warning"></i>
                                                        <span class="text-info">(Xem 4 đánh giá)</span>
                                                    </div> --}}
                                                <div class="d-flex align-items-center">
                                                    <div class="star-ratings" style="font-size: 22px;">
                                                        <div class="fill-ratings d-flex" style="width: 86%;">
                                                            <!-- Giả sử muốn hiển thị 4.3 sao, set width là 86% -->
                                                            <span>★★★★★</span>
                                                        </div>
                                                        <div class="empty-ratings ">
                                                            <span>★★★★★</span>
                                                        </div>
                                                    </div>

                                                    <span class="text-normal ml-3 f-14 mt-1">Đã bán 127</span>

                                                </div>
                                            </div>

                                            <div style="display: flex; align-items: center;">
                                                <h5 class="mr-3 mb-0 text-danger">590.000₫</h5>
                                                <h5 class="mr-3 mb-0" style="color: #6c757d; font-size:15px;">
                                                    <del>737.500₫</del>
                                                </h5>
                                                <span class="badge badge-danger" style="font-size: 16px;">-20%</span>
                                            </div>

                                            <div class="text-right mt-3">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var productRow = document.querySelector(
                '.product-row'); // Thay thế 'product-row' bằng class hoặc ID của row chứa sản phẩm của bạn
            var products = productRow.children;
            var count = products.length;

            var colClass = '';
            if (count === 1) {
                colClass = 'col-sm-12 col-md-12 col-lg-12 col-xl-12 p-b-30';
            } else if (count === 2) {
                colClass = 'col-sm-12 col-md-6 col-lg-6 col-xl-6 p-b-30';
            } else if (count === 3) {
                colClass = 'col-sm-12 col-md-6 col-lg-4 col-xl-4 p-b-30';
            } else {
                colClass = 'col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30';
            }

            Array.from(products).forEach(function(product) {
                product.className = colClass; // Điều chỉnh cho phù hợp với các breakpoint khác nếu cần
            });
        });
    </script>
@endsection
