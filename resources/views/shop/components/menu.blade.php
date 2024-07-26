<div id="menu-box">
    <div class="p-l-20 p-r-10">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Danh mục
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if ($categories->count())
                        @foreach ($categories as $category)
                            <a class="dropdown-item"
                                href="{{ route('shop.products.byCategory', ['category' => $category->id]) }}">{{ $category->name }}</a>
                        @endforeach
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('shop.index') }}">Tất cả</a>
                </div>
            </li>

            <li class="nav-item p-r-10 {{ $activeHome ?? '' }} ">
                <a class="nav-link" href="{{ route('shop.index') }}">Trang chủ</a>
            </li>
            {{-- <li class="nav-item p-r-10">
                <a class="nav-link" href="#">Liên hệ</a>
            </li>
            <li class="nav-item p-r-10 ">
                <a class="nav-link" href="#">Thông tin</a>
            </li> --}}
            <li class="nav-item p-r-10 {{ $activeCart ?? '' }}">
                <a class="nav-link" href="{{ route('cart.index') }}">Giỏ hàng</a>
            </li>
            <li class="nav-item p-r-10 {{ $activeOrder ?? '' }}">
                <a class="nav-link" href="{{ route('order.show') }}">Đơn mua</a>
            </li>

        </ul>
        <div class="mobile-active">
            <form class="form-inline my-2 my-lg-0" action="{{ route('shop.index') }}" method="GET">
                <div>
                    <input id="searchInput-mobile" class="form-control mr-sm-2" type="search" name="search"
                        aria-label="Search" value="{{ request('search') }}">
                </div>
                <div>
                    <button class="btn btn-outline-info my-2 my-sm-0" type="submit" style="text-transform: none">Tìm
                        kiếm</button>
                </div>
            </form>
        </div>
    </div>

</div>
