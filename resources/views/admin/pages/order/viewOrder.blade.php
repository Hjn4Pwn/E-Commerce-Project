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

                                    <div class="col-sm-3">
                                        <span class="" style ="font-size: 18px;">
                                            Status:
                                        </span>
                                    </div>
                                    <div class="col-sm-9">
                                        <span class="bg-danger"
                                            style ="font-size: 20px; padding: 10px; border-radius: 2px;">
                                            Inprocess
                                        </span>
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
                                                    <input type="text" class="form-control" placeholder="John Cena"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control"
                                                        placeholder="JohnCena@gmail.com" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="0794452065"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Payment</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="1908736495"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <div class="form-control-static text-info">KTX Khu B
                                                        DHQG,
                                                        Phường Linh Trung, TP Thủ Đức, TPHCM
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Note</label>
                                                <div class="col-sm-9">
                                                    <div class="form-control-static text-muted">Ostrovit
                                                        Creatine
                                                        là sản phẩm cung cấp Creatine Monohydrate tinh
                                                        khiết nhất của nhà Ostrovit cho tới thời điểm
                                                        hiện tại. Với sự cải tiến vượt bậc khi áp dụng
                                                        công thức, mẫu mã mới đi kèm với đó là những cái
                                                        chất rất riêng mà chỉ Ostrovit Creatine có được
                                                        như: Đa dạng về hương vị và giá thành dễ tiếp
                                                        cận, chắc chắn Ostrovit Creatine là một trong
                                                        dòng Creatine tốt, được nhiều tin tưởng sử dụng
                                                        nhất hiện nay.
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
                                                    <tr>
                                                        <th class="" scope="row">1</th>
                                                        <td class="">Ostrovit Creatine
                                                            Monohydrate
                                                            500g
                                                        </td>
                                                        <td class="text-center p-t-5"><img
                                                                src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                                                class="rounded-3" style="width: 100px; "
                                                                alt="Product Image" /></td>
                                                        <td class=" text-center">1</td>
                                                        <td class=" text-center">590000 VND</td>
                                                    </tr>

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
                                                    <input type="text" class="form-control" placeholder="590000 VND"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Ship</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" placeholder="30000 VND"
                                                        readonly>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label form-bg-primary">Total</label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-static text-success"
                                                        style="font-size: 26px; font-weight: bold;">
                                                        620000
                                                        VND</div>
                                                </div>
                                            </div>

                                            <div class="float-right">
                                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                                    Ship
                                                </button>
                                            </div>

                                        </form>

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
@endsection
