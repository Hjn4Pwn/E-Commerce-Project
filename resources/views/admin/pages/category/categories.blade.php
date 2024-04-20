@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeCategories' => 'active'])
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
                                <h5>List of Categories</h5>
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

                                    <form class="form-material float-right" action="{{ route('admin.addCategory') }}"
                                        method="get">
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">
                                                Add Category
                                            </button>
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
                                                <th>Name</th>
                                                <th>Number of Products</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th class="lh40" scope="row">1</th>
                                                <td class="lh40">Creatine</td>
                                                <td class="lh40">5</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.editCategory') }}"
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
