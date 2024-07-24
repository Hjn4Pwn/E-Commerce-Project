<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        {{-- <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="../AdminResource/images/avatar-4.jpg" alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">Huy Na<i class="fa fa-caret-down"></i></span>
                </div>
            </div>
            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="user-profile.html"><i class="ti-user"></i>View Profile</a>
                        <a href="#!"><i class="ti-settings"></i>Settings</a>
                        <a href="auth-normal-sign-in.html"><i class="ti-layout-sidebar-left"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </div> --}}
        <div class="pcoded-navigation-label"></div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeDashboard ?? '' }}">
                <a href="{{ route('admin.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-house"></i><b>D</b></span>
                    <span class="pcoded-mtext">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeUsers ?? '' }}">
                <a href="{{ route('admin.users.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-users"></i><b>D</b></span>
                    <span class="pcoded-mtext">Users</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeCategories ?? '' }}">
                <a href="{{ route('admin.categories.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-layer-group"></i><b>D</b></span>
                    <span class="pcoded-mtext">Categories</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeProducts ?? '' }}">
                <a href="{{ route('admin.products.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-boxes-stacked"></i><b>D</b></span>
                    <span class="pcoded-mtext">Products</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeFlavors ?? '' }}">
                <a href="{{ route('admin.flavors.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-cookie-bite"></i><b>D</b></span>
                    <span class="pcoded-mtext">Flavors</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeOrders ?? '' }}">
                <a href="{{ route('admin.orders.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-cart-flatbed"></i><b>D</b></span>
                    <span class="pcoded-mtext">Orders</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeReviews ?? '' }}">
                <a href="{{ route('admin.reviews.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-flag"></i><b>D</b></span>
                    <span class="pcoded-mtext">Reviews</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>

    </div>
</nav>
