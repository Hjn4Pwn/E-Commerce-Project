@extends('admin.layout')

@section('content')
    @include('admin.components.navbar')
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
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Update Admin Infomation</h5>
                                    </div>
                                    <div class="card-block">
                                        <form>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="Huy Na">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="huyna@gmail.com">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Phone</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="0784402389">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Payment</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="0784402389">
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
