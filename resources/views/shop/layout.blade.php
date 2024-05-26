<!DOCTYPE html>
<html lang="en">

<head>
    @include('shop.components.head')
</head>

<body>
    <!-- Pre-loader start -->
    @include('shop.components.preLoader')
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('shop.components.header')

            <div class="pcoded-main-container ">
                <div class="pcoded-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('shop.components.footer')
    @include('shop.components.script')
</body>

</html>
