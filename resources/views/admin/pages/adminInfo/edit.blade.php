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
                                        <form method="POST" action="{{ route('admin.update') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $admin->name }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="email"
                                                        value="{{ $admin->email }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Phone</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="phone"
                                                        value="{{ $admin->phone }}">
                                                </div>
                                            </div>

                                            {{-- <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Payment</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="0784402389">
                                                </div>
                                            </div> --}}

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Upload Avatar</label>
                                                <div class="col-sm-2">
                                                    <img src="{{ asset($admin->avatar) }}" class="rounded-3 avatar"
                                                        id="avatar-preview" style="width: 100px;" alt="" />
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="avatar" type="file" class="form-control imageInput"
                                                        data-target="#avatar-preview">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Province</label>
                                                <div class="col-sm-10">
                                                    @if ($provinces->count())
                                                        <select id="provinceSelect" name="province_id"
                                                            class="form-control select2-format " style="width:100%;">
                                                            @if (!$admin->province)
                                                                <option>Please select one</option>
                                                            @else
                                                                <option value="{{ $admin->province->code }}">
                                                                    {{ $admin->province->name }}</option>
                                                            @endif
                                                            @foreach ($provinces as $province)
                                                                <option value={{ $province->code }}>
                                                                    {{ $province->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">District</label>
                                                <div class="col-sm-10">
                                                    <select id="districtSelect" name="district_id"
                                                        class="form-control select2-format" style="width:100%;">
                                                        @if (!$admin->district)
                                                            <option>Please select one</option>
                                                        @else
                                                            <option value="{{ $admin->district->code }}">
                                                                {{ $admin->district->name }}</option>
                                                        @endif
                                                        {{--  --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Ward</label>
                                                <div class="col-sm-10">
                                                    <select id="wardSelect" name="ward_id"
                                                        class="form-control select2-format" style="width:100%;">
                                                        @if (!$admin->ward)
                                                            <option>Please select one</option>
                                                        @else
                                                            <option value="{{ $admin->ward->code }}">
                                                                {{ $admin->ward->name }}</option>
                                                        @endif
                                                        {{--  --}}
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">
                                                    Address</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="address_detail"
                                                        value="{{ $admin->address_detail }}">
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
            $('.imageInput').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.avatar').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>

    {{-- select2 --}}
    <script>
        $(document).ready(function() {
            $('.select2-format').select2();
        });
    </script>

    {{-- render Provinces, Districts, Wards --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- get Districts By Province Id --}}
    <script>
        $(document).ready(function() {
            $('#provinceSelect').on('change', function() {
                var provinceId = $(this).val();
                if (provinceId) {
                    $.ajax({
                        url: '/getDistricts/' + provinceId,
                        type: 'GET',
                        timeout: 5000,
                        success: function(data) {
                            $('#districtSelect').html(data);
                            // $('#districtSelect').select2();
                        },
                        error: function(xhr, status, error) {
                            console.error("Failed to fetch districts: " + error);
                            alert("Could not fetch data. Please try again later.");
                        }
                    });
                } else {
                    $('#districtSelect').html('<option value="">Select a District</option>');
                }
            });
        });
    </script>

    {{-- get Wards By District Id --}}
    <script>
        $(document).ready(function() {
            $('#districtSelect').on('change', function() {
                var districtId = $(this).val();
                if (districtId) {
                    $.ajax({
                        url: '/getWards/' + districtId,
                        type: 'GET',
                        timeout: 5000,
                        success: function(data) {
                            $('#wardSelect').html(data);
                            // $('#wardSelect').select2();
                        },
                        error: function(xhr, status, error) {
                            console.error("Failed to fetch wards: " + error);
                            alert("Could not fetch data. Please try again later.");
                        }
                    });
                } else {
                    $('#wardSelect').html('<option value="">Select a Ward</option>');
                }
            });
        });
    </script>
@endsection
