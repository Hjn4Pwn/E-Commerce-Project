@extends('shop.layout')

@section('content')
    {{-- @include('shop.components.navbar') --}}
    {{-- @include('shop.components.pageHeader') --}}

    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">

                    @include('shop.components.breadcrumb')

                    <div class="row justify-content-center">
                        <div class="col-md-10 bg-white p-5">

                            <div class="row align-items-center product-bottom-line" style="height: 150px;">
                                <!-- Ensure there's a height to allow for vertical centering -->
                                <div class="col-3 col-md-2">
                                    <!-- Cột này chứa hình ảnh và luôn giữ nguyên không thay đổi khi thu nhỏ màn hình -->
                                    <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                        class="rounded-3 cart-product-image"alt="Product Image" />
                                </div>
                                <div class="col-9 col-md-10">
                                    <!-- Cột này chứa tất cả thông tin khác và sẽ điều chỉnh kích thước khi màn hình thay đổi -->
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <!-- Phần chứa tên và mùi vị sản phẩm -->
                                            <div>
                                                <div class="cart-product-name">
                                                    Ostrovit Creatine Monohydrate 500g
                                                </div>
                                                <div class="cart-flavor">
                                                    Unflavoured
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 d-flex align-items-center justify-content-between">
                                            <!-- Phần chứa giá, số lượng và nút xóa, được sắp xếp lại khi màn hình thu nhỏ -->
                                            <h5 class="text-danger mr-2">590.000₫</h5>
                                            <input type="number" class="text-center mr-2" style="width: 100px;"
                                                value="1" min="1">
                                            <form class="mr-2">
                                                <button type="submit" class="btn btn-danger waves-effect waves-light">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center product-bottom-line" style="height: 150px;">
                                <!-- Ensure there's a height to allow for vertical centering -->
                                <div class="col-3 col-md-2">
                                    <!-- Cột này chứa hình ảnh và luôn giữ nguyên không thay đổi khi thu nhỏ màn hình -->
                                    <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                        class="rounded-3 cart-product-image"alt="Product Image" />
                                </div>
                                <div class="col-9 col-md-10">
                                    <!-- Cột này chứa tất cả thông tin khác và sẽ điều chỉnh kích thước khi màn hình thay đổi -->
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <!-- Phần chứa tên và mùi vị sản phẩm -->
                                            <div>
                                                <div class="cart-product-name">
                                                    BioTechUSA Hydro Whey Zero, 4 Lbs (1,816 Kg)
                                                </div>
                                                <div class="cart-flavor">
                                                    Unflavoured
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 d-flex align-items-center justify-content-between">
                                            <!-- Phần chứa giá, số lượng và nút xóa, được sắp xếp lại khi màn hình thu nhỏ -->
                                            <h5 class="text-danger mr-2">1.950.000₫</h5>
                                            <input type="number" class="text-center mr-2" style="width: 100px;"
                                                value="1" min="1">
                                            <form class="mr-2">
                                                <button type="submit" class="btn btn-danger waves-effect waves-light">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center product-bottom-line" style="height: 150px;">
                                <!-- Ensure there's a height to allow for vertical centering -->
                                <div class="col-3 col-md-2">
                                    <!-- Cột này chứa hình ảnh và luôn giữ nguyên không thay đổi khi thu nhỏ màn hình -->
                                    <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                        class="rounded-3 cart-product-image"alt="Product Image" />
                                </div>
                                <div class="col-9 col-md-10">
                                    <!-- Cột này chứa tất cả thông tin khác và sẽ điều chỉnh kích thước khi màn hình thay đổi -->
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <!-- Phần chứa tên và mùi vị sản phẩm -->
                                            <div>
                                                <div class="cart-product-name">
                                                    Ostrovit Creatine Monohydrate 500g
                                                </div>
                                                <div class="cart-flavor">
                                                    Unflavoured
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 d-flex align-items-center justify-content-between">
                                            <!-- Phần chứa giá, số lượng và nút xóa, được sắp xếp lại khi màn hình thu nhỏ -->
                                            <h5 class="text-danger mr-2">590.000₫</h5>
                                            <input type="number" class="text-center mr-2" style="width: 100px;"
                                                value="1" min="1">
                                            <form class="mr-2">
                                                <button type="submit" class="btn btn-danger waves-effect waves-light">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center product-bottom-line" style="height: 150px;">
                                <!-- Ensure there's a height to allow for vertical centering -->
                                <div class="col-3 col-md-2">
                                    <!-- Cột này chứa hình ảnh và luôn giữ nguyên không thay đổi khi thu nhỏ màn hình -->
                                    <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                        class="rounded-3 cart-product-image"alt="Product Image" />
                                </div>
                                <div class="col-9 col-md-10">
                                    <!-- Cột này chứa tất cả thông tin khác và sẽ điều chỉnh kích thước khi màn hình thay đổi -->
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <!-- Phần chứa tên và mùi vị sản phẩm -->
                                            <div>
                                                <div class="cart-product-name">
                                                    BioTechUSA Hydro Whey Zero, 4 Lbs (1,816 Kg)
                                                </div>
                                                <div class="cart-flavor">
                                                    Unflavoured
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 d-flex align-items-center justify-content-between">
                                            <!-- Phần chứa giá, số lượng và nút xóa, được sắp xếp lại khi màn hình thu nhỏ -->
                                            <h5 class="text-danger mr-2">1.950.000₫</h5>
                                            <input type="number" class="text-center mr-2" style="width: 100px;"
                                                value="1" min="1">
                                            <form class="mr-2">
                                                <button type="submit" class="btn btn-danger waves-effect waves-light">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- <div class="row align-items-center product-bottom-line" style="height: 150px;">
                                <div class="col-3 col-md-2">
                                    <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                        class="rounded-3 cart-product-image" alt="Product Image" />
                                </div>
                                <div class="col-9 col-md-10">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="cart-product-name">
                                                Ostrovit Creatine Monohydrate 500g
                                            </div>
                                            <div class="cart-flavor">
                                                Unflavoured
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 d-flex align-items-center">
                                            <div style="flex-grow: 1; min-width: 0;">
                                                <!-- Flexible but does not shrink past content size -->
                                                <h5 class="text-danger">590.000₫</h5>
                                            </div>
                                            <div class="cart-product-quantity">
                                                <!-- Fixed width for the input to maintain alignment -->
                                                <input type="number" class="form-control text-center" value="1"
                                                    min="1">
                                            </div>
                                            <div> <!-- No need for flex-grow as the button size is generally constant -->
                                                <form>
                                                    <button type="submit" class="btn btn-danger waves-effect waves-light">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}



                            <div class="mb-3 mt-5" style="height: 150px;">
                                <div class="f-18  text-info font-weight-bold">Ghi chú đơn hàng:</div>
                                <div class="mt-2"> <!-- Added margin top for spacing -->
                                    <textarea class="form-control" rows="3" placeholder="Nhập ghi chú của bạn tại đây..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3"></div>

                </div>
            </div>
        </div>
        <!-- Page-body end -->
        <div class="mb-5"></div>
    </div>
@endsection
