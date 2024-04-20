@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeCustomers' => 'active'])
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
                                        <h5>Update Customer Infomation</h5>
                                    </div>
                                    <div class="card-block">
                                        <form>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="Mark JopsCorn">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="Otto@gmail.com">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Phone</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="0123456789">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Payment</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="1908736495" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Upload Image</label>
                                                <div class="col-sm-2">
                                                    <img id="customerImage"
                                                        src={{ asset('AdminResource/images/test/sampleAvatar.png') }}
                                                        class="rounded-3" style="width: 100px; " alt="Product Image" />
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="file" class="form-control" id="imageInput">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Province</label>
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
                                                <label class="col-sm-2 col-form-label">District</label>
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
                                                <label class="col-sm-2 col-form-label">Ward</label>
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
                </div>
            </div>
            <!-- Page-body end -->
        </div>
        <div id="styleSelector"> </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#imageInput').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#customerImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
