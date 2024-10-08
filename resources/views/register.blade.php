<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gym Store</title>
    @include('admin.components.head')
</head>

<body themebg-pattern="theme1">
    @include('admin.components.preLoader')
    <section class="login-block">
        <div class="container no-select">
            <div class="row">
                <div class="col-sm-12">
                    <form class="md-float-material form-material" method="post" action="{{ route('register.post') }}">
                        @csrf
                        <div class="text-center">
                            <img src="{{ asset('AdminResource/images/test/logo.png') }}" alt="Logo">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Đăng ký</h3>
                                    </div>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group form-primary">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name') }}" placeholder=" ">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Tên</label>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ old('email') }}" placeholder=" ">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Email</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="password" name="password" class="form-control" placeholder=" ">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Mật khẩu</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder=" ">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Xác nhận mật khẩu</label>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="role" id="role" value="user-register">

                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group form-primary">
                                            <input type="text" name="code" class="form-control"
                                                value="{{ old('code') }}" placeholder=" ">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Nhập mã được gửi qua email</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-primary">
                                            <button type="button" id="send-code-btn"
                                                class="btn btn-info btn-sm btn-block waves-effect waves-light text-center">
                                                Gửi mã
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                @endif

                                <div class="row text-left">
                                    <div class="col-12">
                                        <div class="forgot-phone text-right f-right">
                                            <a href="{{ route('login') }}" class="text-right f-w-600">Bạn đã có tài
                                                khoản? Đăng nhập tại đây</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Đăng
                                            ký</button>
                                    </div>
                                </div>
                                <hr />
                                <div class="row align-items-center">
                                    <div class="col-md-10 col-sm-10 col-9 text-left">
                                        <p class="text-inverse m-b-0">Cảm ơn bạn.</p>
                                        <p class="text-inverse"><a href="{{ route('shop.index') }}"><b>Quay lại trang
                                                    chủ</b></a></p>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-3 text-right">
                                        <img src="{{ asset('AdminResource/images/test/small-logo.png') }}"
                                            alt="Small Logo" style="width: 50px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    @include('admin.components.script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#send-code-btn').click(function() {
                var email = $('#email').val();
                var role = $('#role').val();
                if (email) {
                    $.ajax({
                        url: "{{ route('send.verification.code') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            email: email,
                            role: role
                        },
                        success: function(response) {
                            alert('Mã xác thực đã được gửi tới email của bạn.');
                        },
                        error: function(response) {
                            alert('Không thể gửi mã xác thực thành công.');
                        }
                    });
                } else {
                    alert('Please enter your email.');
                }
            });

        });
    </script>

</body>

</html>
