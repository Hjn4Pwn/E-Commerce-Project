<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.components.head')
</head>

<body>
    <!-- Pre-loader start -->
    @include('admin.components.preLoader')
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('admin.components.header')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('admin.components.script')
</body>

</html>
