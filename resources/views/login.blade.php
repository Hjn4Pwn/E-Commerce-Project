<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gym Store</title>
    @include('admin.components.head')
</head>

<body themebg-pattern="theme1">
    @include('admin.components.preLoader')
    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <form class="md-float-material form-material" method="post" action="{{ route('login.post') }}">
                        @csrf
                        <div class="text-center">
                            <img src="{{ asset('AdminResource/images/test/logo.png') }}" alt="Logo">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-10">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Đăng nhập</h3>
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
                                    <input type="text" name="email" class="form-control"
                                        value="{{ old('email') }}" placeholder=" ">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Email</label>
                                </div>

                                <div class="form-group form-primary">
                                    <input type="password" name="password" class="form-control" placeholder=" ">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Mật khẩu</label>
                                </div>

                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                @endif

                                <div class="row m-t-10 text-left">
                                    <div class="col-12">
                                        <div class="forgot-phone text-left f-left">
                                            <a href="{{ route('register') }}" class="text-right f-w-600">Đăng ký tại
                                                đây</a>
                                        </div>
                                        <div class="forgot-phone text-right f-right">
                                            <a href="{{ route('user.showResetPasswordForm') }}"
                                                class="text-right f-w-600">Quên
                                                mật
                                                khẩu?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Đăng
                                            nhập</button>
                                    </div>
                                </div>
                                <hr />

                                <div class="row mb-2">
                                    <a href="{{ route('auth.facebook') }}" class="btn btn-outline-primary col-md-12"
                                        style="text-transform: none;">
                                        <i class="fa-brands fa-facebook-f"></i> Đăng nhập bằng Facebook
                                    </a>
                                </div>

                                <div class="row mb-2">
                                    <a href="{{ route('auth.google') }}" class="btn btn-outline-warning col-md-12"
                                        style="text-transform: none;">
                                        <i class="fa-brands fa-google"></i> Đăng nhập bằng Google
                                    </a>
                                </div>


                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Cảm ơn bạn.</p>
                                        <p class="text-inverse text-left"><a href="{{ route('shop.index') }}"><b>Quay
                                                    lại trang chủ</b></a></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('AdminResource/images/test/small-logo.png') }}"
                                            alt="Small Logo" style="width: 80%;">
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
</body>

</html>
