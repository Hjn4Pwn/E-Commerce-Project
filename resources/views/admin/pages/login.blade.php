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
                    <form class="md-float-material form-material" method="post" action="{{ route('admin.login.post') }}">
                        @csrf
                        <div class="text-center">
                            <img src={{ asset('AdminResource/images/test/logo.png') }} alt="logo.png">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
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

                                <div class="row m-t-25 text-left">
                                    <div class="col-12">

                                        <div class="forgot-phone text-right f-right">
                                            <a href="{{ route('admin.showResetPasswordForm') }}"
                                                class="text-right f-w-600"> Quên mật
                                                khẩu?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Đăng
                                            nhập</button>
                                    </div>
                                </div>
                                <hr />
                                <div class="row align-items-center">
                                    <div class="col-md-10 col-sm-10 col-9 text-left">
                                        <p class="text-inverse m-b-0">Cảm ơn bạn.</p>
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
</body>

</html>
