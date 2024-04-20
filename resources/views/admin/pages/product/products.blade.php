@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeProducts' => 'active'])
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
                                <h5>List of Products</h5>
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
                                <div class="p-30 p-b-0 p-t-0 ">

                                    <form class="form-material float-right" action="{{ route('admin.addProduct') }}"
                                        method="get">
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">
                                                Add Product
                                            </button>
                                        </div>
                                    </form>

                                </div>
                                <div class="p-30 p-b-0 p-t-0 ">
                                    <form class="form-material" method="post">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Choose
                                                Category</label>
                                            <div class="col-sm-6">
                                                <select name="select" class="form-control">
                                                    <option value="opt1">Select one to view
                                                        Products
                                                    </option>
                                                    <option value="opt2">Creatine</option>
                                                    <option value="opt3">Whey</option>
                                                    <option value="opt4">Pre Workout</option>
                                                    <option value="opt5">Vitamin</option>
                                                    <option value="opt6">Omega 3</option>
                                                    <option value="opt7">T-Shirt</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button class="btn btn-info waves-effect waves-light">Get
                                                    Products</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
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
                                                <th width=15%>Name </th>
                                                <th class="text-center">Image</th>
                                                <th width=30%>Describe</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center" width=15%>Price</th>
                                                <th class="text-center" width=20%>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th class="" scope="row">1</th>
                                                <td class="">Ostrovit Creatine Monohydrate 500g
                                                </td>
                                                <td class="text-center p-t-5"><img
                                                        src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                                        class="rounded-3" style="width: 100px; " alt="Product Image" /></td>
                                                <td>Ostrovit Creatine là sản phẩm cung cấp Creatine
                                                    Monohydrate tinh khiết nhất của nhà Ostrovit cho tới
                                                    thời điểm hiện tại. Với sự cải tiến vượt bậc khi áp
                                                    dụng công thức ...</td>
                                                <td class=" text-center">176</td>
                                                <td class=" text-center">590000 VND</td>

                                                <td class="text-center">
                                                    <a href="{{ route('admin.editProduct') }}"
                                                        class="btn btn-primary waves-effect waves-light">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="" class="btn btn-danger waves-effect waves-light">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>

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
