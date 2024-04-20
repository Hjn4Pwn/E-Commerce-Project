@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeCategories' => 'active'])
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
                        <div class="row justify-content-center">


                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Update Category Name</h5>
                                        <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                    </div>
                                    <div class="card-block">
                                        <form class="form-material">
                                            <div class="form-group form-default">
                                                <input type="text" name="footer-email" class="form-control">
                                                <span class="form-bar"></span>
                                                <label class="float-label">Category Name</label>
                                            </div>
                                            <div class="float-right">
                                                <button type="submit" class="btn btn-info waves-effect waves-light">
                                                    Update
                                                </button>
                                            </div>
                                        </form>
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
@endsection
