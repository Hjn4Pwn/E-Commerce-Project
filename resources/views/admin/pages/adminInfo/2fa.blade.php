@extends('admin.layout')

@section('content')
    @include('admin.components.navbar')
    <div class="pcoded-content">
        @include('admin.components.pageHeader', ['page' => 'Xác thực 2 yếu tố'])
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Xác thực 2 yếu tố</h5>
                                    </div>
                                    <div class="card-block text-center">

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if (!$enabled)
                                            {!! $google2fa_url !!}
                                            <p>Quét mã này bằng ứng dụng Google Authenticator.</p>

                                            <form action="{{ route('2fa.enable.verify') }}" method="POST">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="one_time_password" class="col-sm-3 col-form-label">Nhập mã
                                                        OTP</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control" id="one_time_password"
                                                            name="one_time_password">
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-sm btn-block waves-effect waves-light text-center m-b-20">Xác
                                                            thực</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            {!! $google2fa_url !!}
                                            <form method="POST" action="{{ route('2fa.disable') }}" class="mt-3">
                                                @csrf
                                                <button type="submit" class="btn btn-danger waves-effect waves-light">Tắt
                                                    2FA</button>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="styleSelector"> </div>
    </div>
@endsection
