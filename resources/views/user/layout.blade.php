<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.components.head')
</head>

<body>
    <!-- Pre-loader start -->
    @include('user.components.preLoader')
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('user.components.header')

            <div class="pcoded-main-container ">
                <div class="pcoded-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('user.components.footer')
    @include('user.components.script')
</body>

</html>
