<nav class="navbar header-navbar pcoded-header ">
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
            <a class="image-link" href="{{ route('admin.index') }}">
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
                {{-- <li>
                            <a href="#!" onclick="javascript:toggleFullScreen()"
                                class="waves-effect waves-light">
                                <i class="ti-fullscreen"></i>
                            </a>
                        </li> --}}
            </ul>

            {{-- <div class="col-lg-7 header__search"> --}}
            {{-- <div class="row hearder__search-box">
                        <div class="col-sm-11">
                            <input type="text" class="header__search-input" style
                                placeholder="Tìm kiếm sản phẩm">
                            <!-- Search -->
                        </div>
                        <div class="col-sm-1">
                            <button class="header__search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div> --}}
            {{-- <form method="get">
                        <div class="form-group row hearder__search-box justify-content-center">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                        </div>
                    </form> --}}
            {{-- </div> --}}


            <ul class="nav-right">
                <li class="header-notification">
                    <a href="#!" class="waves-effect waves-light p-b-0 p-t-10" style="font-size: 18px;">
                        <i class="fa-solid fa-bell"></i>
                        <span class="badge bg-c-red"></span>
                    </a>
                    <ul class="show-notification">
                        <li>
                            <h6>Notifications</h6>
                            <label class="label label-danger">New</label>
                        </li>
                        <li class="waves-effect waves-light">
                            <div class="media">
                                <img class="d-flex align-self-center img-radius"
                                    src={{ asset('AdminResource/images/avatar-2.jpg') }}
                                    alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="notification-user">Huy Na</h5>
                                    <p class="notification-msg">Lorem ipsum dolor sit amet,
                                        consectetuer
                                        elit.</p>
                                    <span class="notification-time">30 minutes ago</span>
                                </div>
                            </div>
                        </li>
                        <li class="waves-effect waves-light">
                            <div class="media">
                                <img class="d-flex align-self-center img-radius"
                                    src={{ asset('AdminResource/images/avatar-4.jpg') }}
                                    alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="notification-user">Joseph William</h5>
                                    <p class="notification-msg">Lorem ipsum dolor sit amet,
                                        consectetuer
                                        elit.</p>
                                    <span class="notification-time">30 minutes ago</span>
                                </div>
                            </div>
                        </li>
                        <li class="waves-effect waves-light">
                            <div class="media">
                                <img class="d-flex align-self-center img-radius"
                                    src={{ asset('AdminResource/images/avatar-3.jpg') }}
                                    alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="notification-user">Sara Soudein</h5>
                                    <p class="notification-msg">Lorem ipsum dolor sit amet,
                                        consectetuer
                                        elit.</p>
                                    <span class="notification-time">30 minutes ago</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="header-notification">
                    <a href="#!" class="waves-effect waves-light p-b-0 p-t-10" style="font-size: 18px;">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="badge bg-c-red"></span>
                    </a>
                    <ul class="show-notification">
                        <li>
                            <h6>Cart</h6>
                            <label class="label label-danger">New</label>
                        </li>
                        <li class="waves-effect waves-light">
                            <div class="media">
                                <img class="d-flex align-self-center img-radius"
                                    src={{ asset('AdminResource/images/avatar-2.jpg') }}
                                    alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="notification-user">Huy Na</h5>
                                    <p class="notification-msg">Lorem ipsum dolor sit amet,
                                        consectetuer
                                        elit.</p>
                                    <span class="notification-time">30 minutes ago</span>
                                </div>
                            </div>
                        </li>
                        <li class="waves-effect waves-light">
                            <div class="media">
                                <img class="d-flex align-self-center img-radius"
                                    src={{ asset('AdminResource/images/avatar-4.jpg') }}
                                    alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="notification-user">Joseph William</h5>
                                    <p class="notification-msg">Lorem ipsum dolor sit amet,
                                        consectetuer
                                        elit.</p>
                                    <span class="notification-time">30 minutes ago</span>
                                </div>
                            </div>
                        </li>
                        <li class="waves-effect waves-light">
                            <div class="media">
                                <img class="d-flex align-self-center img-radius"
                                    src={{ asset('AdminResource/images/avatar-3.jpg') }}
                                    alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="notification-user">Sara Soudein</h5>
                                    <p class="notification-msg">Lorem ipsum dolor sit amet,
                                        consectetuer
                                        elit.</p>
                                    <span class="notification-time">30 minutes ago</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="user-profile header-notification">
                    <a href="#!" class="waves-effect waves-light p-b-0 p-t-10">
                        <img src={{ asset('AdminResource/images/test/sampleAvatar.png') }} class="img-radius"
                            alt="User-Profile-Image">
                        <span>Huy Na</span>
                        <i class="ti-angle-down"></i>
                    </a>
                    <ul class="show-notification profile-notification">
                        {{-- <li class="waves-effect waves-light">
                                    <a href="#!">
                                        <i class="ti-settings"></i> Settings
                                    </a>
                                </li> --}}
                        <li class="waves-effect waves-light p-b-0 p-t-0 ">
                            <a href="{{ route('admin.editAdminProfile') }}">
                                <i class="fa-solid fa-user"></i> Profile
                            </a>
                        </li>
                        <li class="waves-effect waves-light p-b-0 p-t-0">
                            <a href="email-inbox.html">
                                <i class="fa-solid fa-message"></i> My Messages
                            </a>
                        </li>
                        <li class="waves-effect waves-light p-b-0 p-t-0">
                            <a href="{{ route('admin.changePassword') }}">
                                <i class="fa-solid fa-lock"></i> Change Password
                            </a>
                        </li>
                        {{-- <li class="waves-effect waves-light">
                                    <a href="auth-lock-screen.html">
                                        <i class="ti-lock"></i> Lock Screen
                                    </a>
                                </li> --}}
                        <li class="waves-effect waves-light p-b-0 p-t-0">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var menuIcon = document.getElementById('mobile-collapse'); // Lấy phần tử icon menu
        var menuBox = document.getElementById('menu-box'); // Lấy phần tử menu box

        // Sự kiện click vào icon để toggle menu
        menuIcon.addEventListener('click', function() {
            menuBox.classList.toggle('show'); // Toggle class 'show'
        });

        // Sự kiện click vào ngoài menu box để ẩn nó đi
        document.addEventListener('click', function(event) {
            // Kiểm tra xem click có xảy ra ngoài menu box không và menu có đang hiển thị không
            if (!menuBox.contains(event.target) && !menuIcon.contains(event.target) && menuBox.classList
                .contains('show')) {
                menuBox.classList.remove('show'); // Nếu đúng, ẩn menu box
            }
        });
    });
</script>
