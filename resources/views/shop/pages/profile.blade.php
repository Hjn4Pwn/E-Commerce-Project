@extends('shop.layout')

@section('content')
    {{-- @include('shop.components.navbar') --}}
    @include('shop.components.pageHeader', [
        'categories' => $categories,
    ])

    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    {{-- 
                    @include('shop.components.breadcrumb', [
                        'subpage' => 'Profile',
                    ]) --}}

                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Cập nhật thông tin cá nhân</h5>
                                </div>
                                <div class="card-block">
                                    {{-- validation --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if ($user->count())
                                        <form action="{{ route('user.updateProfile') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">
                                                    Tên</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $user->name }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="email"
                                                        value="{{ $user->email }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Số điện thoại</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="phone"
                                                        value="{{ $user->phone }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Tải ảnh đại diện</label>
                                                <div class="col-sm-2">
                                                    <img src="{{ asset($user->avatar) }}" class="rounded-3 avatar"
                                                        id="avatar-preview" style="width: 100px;" alt="" />
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="avatar" type="file" class="form-control imageInput"
                                                        data-target="#avatar-preview">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Tỉnh/Thành phố</label>
                                                <div class="col-sm-10">
                                                    @if ($provinces->count())
                                                        <select id="provinceSelect" name="province_id"
                                                            class="form-control select2-format " style="width:100%;">
                                                            @if (!$user->province)
                                                                <option value="">Chọn Tỉnh/Thành phố</option>
                                                            @else
                                                                <option value="{{ $user->province->code }}">
                                                                    {{ $user->province->name }}</option>
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
                                                <label class="col-sm-2 col-form-label">Quận/Huyện</label>
                                                <div class="col-sm-10">
                                                    <select id="districtSelect" name="district_id"
                                                        class="form-control select2-format" style="width:100%;">
                                                        @if (!$user->district)
                                                            <option value="">Chọn Quận/Huyện</option>
                                                        @else
                                                            <option value="{{ $user->district->code }}">
                                                                {{ $user->district->name }}</option>
                                                        @endif
                                                        {{--  --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Phường/Xã</label>
                                                <div class="col-sm-10">
                                                    <select id="wardSelect" name="ward_id"
                                                        class="form-control select2-format" style="width:100%;">
                                                        @if (!$user->ward)
                                                            <option value="">Chọn Phường/Xã</option>
                                                        @else
                                                            <option value="{{ $user->ward->code }}">
                                                                {{ $user->ward->name }}</option>
                                                        @endif
                                                        {{--  --}}
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">
                                                    Địa chỉ cụ thể</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="address_detail"
                                                        value="{{ $user->address_detail }}">
                                                </div>
                                            </div>

                                            {{-- <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Payment</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="payment"
                                                        value="{{ $user->payment }}" readonly>
                                                </div>
                                            </div> --}}
                                            <div class="float-right">
                                                <button type="submit" class="btn btn-info waves-effect waves-light">
                                                    Cập nhật
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
        <div class="mb-5"></div>
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
