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
                    <form class="md-float-material form-material" method="post" action="{{ route('2fa.validate') }}">
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


                                <div class="form-group row">
                                    <label for="one_time_password" class="col-sm-4 col-form-label">Mã OTP</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="one_time_password"
                                            name="one_time_password">
                                    </div>
                                </div>



                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Xác
                                            thực</button>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Cảm ơn bạn.</p>

                                    </div>
                                    <div class="col-md-2">
                                        <img src={{ asset('AdminResource/images/test/small-logo.png') }}
                                            alt="small-logo.png" style="width: 80%">
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
