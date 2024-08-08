<nav class="navbar header-navbar pcoded-header no-select">
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
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-append search-btn"><i
                                    class="ti-search input-group-text"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <a class="image-link" href="{{ route('shop.index') }}">
                <img class="img-fluid Logo-mobile" src={{ asset('AdminResource/images/test/logo.png') }}
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
            </ul>

            <ul class="nav-right">
                <li class="header-notification">
                    <a href="{{ route('cart.index') }}" class="waves-effect waves-light p-b-0 p-t-10"
                        style="font-size: 18px;">
                        <i class="fa-solid fa-cart-shopping f-24 mr-3"></i>
                    </a>
                </li>
                @if (Auth::check())
                    @php
                        $user = Auth::user();
                    @endphp
                    <li class="user-profile header-notification">
                        <a href="#!" class="waves-effect waves-light p-b-0 p-t-10 link_none">
                            @if (!$user->avatar)
                                <img src={{ asset('AdminResource/images/test/nonAuth.png') }} class="img-radius"
                                    alt="User-Profile-Image">
                            @else
                                <img src={{ Storage::disk('s3')->url($user->avatar) }} class="img-radius"
                                    alt="User-Profile-Image">
                            @endif
                            <span>{{ $user->name }}</span>
                            <i class="ti-angle-down"></i>
                        </a>
                        <ul class="show-notification profile-notification">

                            <li class="waves-effect waves-light p-b-0 p-t-0 ">
                                <a href="{{ route('user.editProfile') }}" class="link_none">
                                    <i class="fa-solid fa-user"></i> Tài khoản của tôi
                                </a>
                            </li>

                            @if (!auth()->user()->hasProvider())
                                <li class="waves-effect waves-light p-b-0 p-t-0">
                                    <a href="{{ route('user.showChangePasswordForm') }}" class="link_none">
                                        <i class="fa-solid fa-lock"></i> Đổi mật khẩu
                                    </a>
                                </li>
                            @endif

                            <li class="waves-effect waves-light p-b-0 p-t-0">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" class="link_none"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                                </a>
                            </li>

                        </ul>

                    </li>
                @else
                    <li class="user-profile">
                        <a href="{{ route('login') }}" class="waves-effect waves-light p-b-0 p-t-10 link_none">
                            <img src={{ asset('AdminResource/images/test/nonAuth.png') }} class="img-radius"
                                alt="User-Profile-Image">
                            <span>Đăng nhập</span>
                        </a>
                @endif
            </ul>

        </div>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var menuIcon = document.getElementById('mobile-collapse');
        var menuBox = document.getElementById('menu-box');

        menuIcon.addEventListener('click', function() {
            menuBox.classList.toggle('show');
        });

        document.addEventListener('click', function(event) {
            if (!menuBox.contains(event.target) && !menuIcon.contains(event.target) && menuBox.classList
                .contains('show')) {
                menuBox.classList.remove('show');
            }
        });
    });
</script>
