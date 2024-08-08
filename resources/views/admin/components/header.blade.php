            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <div class="mobile-search waves-effect waves-light">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close"><i
                                                class="ti-close input-group-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn"><i
                                                class="ti-search input-group-text"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.dashboard') }}">
                            <img class="img-fluid" src={{ asset('AdminResource/images/test/logo.png') }}
                                alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()"
                                    class="waves-effect waves-light">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        @php
                            $admin = Auth::guard('admin')->user();
                        @endphp
                        <ul class="nav-right">

                            <li class="user-profile header-notification">
                                <a href="#!" class="waves-effect waves-light link_none">
                                    <img src={{ Storage::disk('s3')->url($admin->avatar ?? 'AdminResource/images/test/sampleAvatar.png') }}
                                        class="img-radius" alt="User-Profile-Image">
                                    <span>{{ $admin->name }}</span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    {{-- <li class="waves-effect waves-light">
                                        <a href="#!">
                                            <i class="ti-settings"></i> Settings
                                        </a>
                                    </li> --}}
                                    <li class="waves-effect waves-light ">
                                        <a href="{{ route('admin.edit') }}" class="link_none">
                                            <i class="fa-solid fa-user"></i> Hồ sơ
                                        </a>
                                    </li>

                                    <li class="waves-effect waves-light">
                                        <a href="{{ route('2fa.enable.form') }}" class="link_none">
                                            <i class="fa-solid fa-lock"></i> Xác thực 2 yếu tố
                                        </a>
                                    </li>

                                    <li class="waves-effect waves-light">
                                        <a href="{{ route('admin.changePassword') }}" class="link_none">
                                            <i class="fa-solid fa-lock"></i> Thay đổi mật khẩu
                                        </a>
                                    </li>
                                    {{-- <li class="waves-effect waves-light">
                                        <a href="auth-lock-screen.html">
                                            <i class="ti-lock"></i> Lock Screen
                                        </a>
                                    </li> --}}
                                    <li class="waves-effect waves-light ">
                                        <a href="{{ route('admin.logout') }}" class="link_none">
                                            <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
