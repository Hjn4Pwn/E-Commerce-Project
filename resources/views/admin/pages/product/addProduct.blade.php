@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeProducts' => 'active'])
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
                                        <h5>Add Product</h5>
                                    </div>
                                    <div class="card-block">
                                        <form>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Product
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Select
                                                    Category</label>
                                                <div class="col-sm-10">
                                                    <select name="select" class="form-control">
                                                        <option value="opt1">Please select one
                                                        </option>
                                                        <option value="opt2">Type 2</option>
                                                        <option value="opt3">Type 3</option>
                                                        <option value="opt4">Type 4</option>
                                                        <option value="opt5">Type 5</option>
                                                        <option value="opt6">Type 6</option>
                                                        <option value="opt7">Type 7</option>
                                                        <option value="opt8">Type 8</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Upload
                                                    Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Product
                                                    Price</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        placeholder="Ex: 900000000 (max 9 digits)" maxlength="9">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Describe</label>
                                                <div class="col-sm-10">
                                                    <textarea rows="5" cols="5" class="form-control" placeholder="Typing ..."></textarea>
                                                </div>
                                            </div>
                                            <div class="float-right">
                                                <button type="submit" class="btn btn-info waves-effect waves-light">
                                                    Add Product
                                                </button>
                                            </div>
                                        </form>
                                    </div>
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
@endsection
