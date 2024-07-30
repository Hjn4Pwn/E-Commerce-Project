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
                                        <h5>Change Admin Password</h5>
                                    </div>
                                    <div class="card-block">
                                        <form action="{{ route('admin.changePassword') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Mật khẩu cũ</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="current_password"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Mật khẩu mới</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="new_password"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Xác nhận mật khẩu mới</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control"
                                                        name="new_password_confirmation" required>
                                                </div>
                                            </div>

                                            <input type="hidden" id="role" name="role"
                                                value="admin-change-password">

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Mã xác thực được gửi qua
                                                    email</label>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-primary">
                                                        <input type="text" name="code" class="form-control" required
                                                            value="{{ old('code') }}">
                                                        <span class="form-bar"></span>

                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group form-primary">
                                                        <button type="button" id="send-code-btn"
                                                            class="btn btn-info btn-sm btn-block waves-effect waves-light text-center">
                                                            Gửi mã
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="float-right">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Cập
                                                    nhật</button>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#send-code-btn').click(function() {
                var role = $('#role').val();

                $.ajax({
                    url: "{{ route('admin.send.verification.code') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        role: role
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            alert(xhr.responseJSON.errors.email[0]);
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            alert(xhr.responseJSON.message);
                        } else {
                            alert('Không thể gửi mã xác thực.');
                        }
                    }
                });
            });
        });
    </script>
@endsection
