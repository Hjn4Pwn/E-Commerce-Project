@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeUsers' => 'active'])
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
                                        <h5>Cập nhật thông tin khách hàng</h5>
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
                                            <form action="{{ route('admin.users.update', ['user' => $user->id]) }}"
                                                method="POST">
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
                                                    <label class="col-sm-2 col-form-label">Ảnh đại diện</label>
                                                    <div class="col-sm-2">
                                                        <img id="userImage"
                                                            src={{ $user->avatar ? Storage::disk('s3')->url($user->avatar) : asset('AdminResource/images/test/nonAuth.png') }}
                                                            class="rounded-3" style="width: 100px; " alt="Product Image" />
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" id="imageInput">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Tỉnh/Thành phố</label>
                                                    <div class="col-sm-10">
                                                        @if ($provinces->count())
                                                            <select id="provinceSelect" name="province"
                                                                class="form-control select2-format " style="width:100%;">
                                                                <option>Chọn Tỉnh/Thành phố
                                                                </option>
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
                                                        <select id="districtSelect" name="district"
                                                            class="form-control select2-format" style="width:100%;">
                                                            <option>Chọn Quận/Huyện
                                                            </option>
                                                            {{--  --}}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Phường/Xã</label>
                                                    <div class="col-sm-10">
                                                        <select id="wardSelect" name="ward"
                                                            class="form-control select2-format" style="width:100%;">
                                                            <option>Chọn Phường/Xã
                                                            </option>
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
                </div>
            </div>
            <!-- Page-body end -->
        </div>
        <div id="styleSelector"> </div>
    </div>

    {{-- frontend upload && show image --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#imageInput').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#userImage').attr('src', e.target.result);
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
