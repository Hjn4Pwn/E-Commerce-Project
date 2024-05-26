<div id="menu-box">
    <div class="p-l-20 p-r-10">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if ($categories->count())
                        @foreach ($categories as $category)
                            <a class="dropdown-item"
                                href="{{ route('shop.products.byCategory', ['category' => $category->id]) }}">{{ $category->name }}</a>
                        @endforeach
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('shop.index') }}">Get All</a>
                </div>
            </li>

            <li class="nav-item p-r-10 {{ $activeHome ?? '' }} ">
                <a class="nav-link" href="{{ route('shop.index') }}">Home</a>
            </li>
            <li class="nav-item p-r-10">
                <a class="nav-link" href="#">Contact </a>
            </li>
            <li class="nav-item p-r-10 ">
                <a class="nav-link" href="#">Info</a>
            </li>
            <li class="nav-item p-r-10 ">
                <a class="nav-link" href="{{ route('shop.cart') }}">Cart</a>
            </li>
            <li class="nav-item p-r-10 ">
                <a class="nav-link" href="#">Order Details</a>
            </li>

        </ul>
        <div class="mobile-active">
            <form class="form-inline">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" type="submit">Search</button>
            </form>
        </div>
    </div>

</div>
