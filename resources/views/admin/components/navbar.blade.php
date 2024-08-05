<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">

        <div class="pcoded-navigation-label"></div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeDashboard ?? '' }}">
                <a href="{{ route('admin.dashboard') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-house"></i><b>D</b></span>
                    <span class="pcoded-mtext">Tổng quan</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeUsers ?? '' }}">
                <a href="{{ route('admin.users.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-users"></i><b>D</b></span>
                    <span class="pcoded-mtext">Khách hàng</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeCategories ?? '' }}">
                <a href="{{ route('admin.categories.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-layer-group"></i><b>D</b></span>
                    <span class="pcoded-mtext">Danh mục</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeProducts ?? '' }}">
                <a href="{{ route('admin.products.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-boxes-stacked"></i><b>D</b></span>
                    <span class="pcoded-mtext">Sản phẩm</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeFlavors ?? '' }}">
                <a href="{{ route('admin.flavors.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-cookie-bite"></i><b>D</b></span>
                    <span class="pcoded-mtext">Hương vị</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeOrders ?? '' }}">
                <a href="{{ route('admin.orders.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-cart-flatbed"></i><b>D</b></span>
                    <span class="pcoded-mtext">Đơn hàng</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeReviews ?? '' }}">
                <a href="{{ route('admin.reviews.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-flag"></i><b>D</b></span>
                    <span class="pcoded-mtext">Đánh giá</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $activeSliders ?? '' }}">
                <a href="{{ route('admin.sliders.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa-solid fa-sliders"></i><b>D</b></span>
                    <span class="pcoded-mtext">Sliders</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>

    </div>
</nav>
