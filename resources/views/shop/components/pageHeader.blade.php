<div class="row menu-box-header">
    @include('shop.components.menu', [
        'activeCart' => 'active',
        'categories' => $categories,
    ])
    <div class="col-sm-12">
        <div style="background-color: white;">
            <div class="navbar-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div>
                            <ul class="navbar-nav mr-auto">

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

                                <li class="nav-item p-r-10 {{ $activeHome ?? '' }}">
                                    <a class="nav-link" href="{{ route('shop.index') }}">Home</a>
                                </li>
                                <li class="nav-item p-r-10">
                                    <a class="nav-link" href="#">Contact</a>
                                </li>
                                <li class="nav-item p-r-10 ">
                                    <a class="nav-link" href="#">Info</a>
                                </li>
                                <li class="nav-item p-r-10 {{ $activeCart ?? '' }}">
                                    <a class="nav-link" href="{{ route('cart') }}">Cart</a>
                                </li>
                                <li class="nav-item p-r-10 ">
                                    <a class="nav-link" href="#">Order Details</a>
                                </li>

                            </ul>
                        </div>
                        <div class="ml-auto">
                            <form class="form-inline my-2 my-lg-0">
                                <div>
                                    <input id="searchInput" class="form-control mr-sm-2" type="search" placeholder=""
                                        aria-label="Search">
                                </div>
                                <div>
                                    <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const inputField = document.getElementById('searchInput');
        const text = "Nhập tên sản phẩm";
        let index = 0;
        let typing = true;

        function typeWriter() {
            if (typing) {
                if (index < text.length) {
                    inputField.placeholder += text.charAt(index);
                    index++;
                    setTimeout(typeWriter, 50);
                } else {
                    typing = false;
                    setTimeout(typeWriter, 1000); // Pause before deleting
                }
            } else {
                if (index > 0) {
                    inputField.placeholder = inputField.placeholder.slice(0, -1);
                    index--;
                    setTimeout(typeWriter, 50);
                } else {
                    typing = true;
                    setTimeout(typeWriter, 100); // Pause before typing again
                }
            }
        }

        typeWriter();
    });
</script>
