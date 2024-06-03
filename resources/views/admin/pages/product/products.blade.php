@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeProducts' => 'active'])
    <div class="pcoded-content">
        <!-- Page-header start -->
        @include('admin.components.pageHeader', ['page' => $page])
        <!-- Page-header end -->
        <div class="pcoded-inner-content">
            <!-- Main-body start -->
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- Page-body start -->
                    <div class="page-body">
                        <div class="card">
                            <div class="card-header">
                                <h5>List of Products</h5>
                                {{-- <span>use class <code>table-hover</code> inside table element</span> --}}
                                <div class="card-header-right">
                                    {{-- <ul class="list-unstyled card-option">
                                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                    <li><i class="fa fa-refresh reload-card"></i></li>
                                    <li><i class="fa fa-trash close-card"></i></li>
                                </ul> --}}
                                </div>
                            </div>
                            <div class="card-block table-border-style">
                                <div class="p-30 p-b-0 p-t-0 ">

                                    <form class="form-material float-right" action="{{ route('admin.products.create') }}"
                                        method="get">
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">
                                                Add Product
                                            </button>
                                        </div>
                                    </form>

                                </div>
                                <div class="p-30 p-b-0 p-t-0 ">
                                    {{-- <form class="form-material" method="get"
                                        action="{{ route('admin.products.byCategory') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Choose Category</label>
                                            <div class="col-sm-6">
                                                <select name="category" class="form-control">
                                                    <option>Select one to view Products</option>
                                                    @if ($categories->count())
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Get
                                                    Products</button>
                                            </div>
                                        </div>
                                    </form> --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form class="form-material" method="get" action="" id="categoryForm">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Choose Category</label>
                                            <div class="col-sm-6">
                                                <select name="category" class="form-control select2-format"
                                                    id="categorySelect">
                                                    <option value="all"
                                                        {{ session('selectedCategory') == 'all' ? 'selected' : '' }}>All
                                                    </option>
                                                    @if ($categories->count())
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ session('selectedCategory') == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>

                                            </div>
                                            {{-- <div class="col-sm-2">
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Get
                                                    Products</button>
                                            </div> --}}
                                        </div>
                                    </form>

                                </div>
                                <div class="table-responsive">

                                    <div class="p-15 p-b-0">
                                        <form class="form-material">
                                            <div class="form-group form-primary">
                                                <input type="text" name="footer-email" class="form-control">
                                                <span class="form-bar"></span>
                                                <label class="float-label"><i class="fa fa-search m-r-10"></i>Search
                                                    by Name</label>
                                            </div>
                                        </form>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center" width=20%>Name </th>
                                                <th class="text-center" width=15%>Image</th>
                                                <th class="text-center" width=15%>Category</th>
                                                <th class="text-center" width=15%>Price</th>
                                                <th class="text-center" width=15%>Quantity</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($products->count())
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <th class="text-center" scope="row">{{ ++$i }}</th>
                                                        <td class="text-center">
                                                            {{ $product->name }}
                                                        </td>
                                                        <td class="text-center p-t-5"><img
                                                                src={{ asset($product->mainImage->path) }} class="rounded-3"
                                                                style="width: 100px; " alt="Product Image" />
                                                        </td>
                                                        {{-- <td>{!! $product->describe !!}</td> --}}
                                                        <td class="text-center">{{ $product->category->name }}</td>
                                                        <td class=" text-center">{{ format_currency($product->price) }}
                                                        </td>
                                                        @if ($outOfStockProducts->contains($product->id))
                                                            <td class=" text-center">Hết hàng</td>
                                                        @else
                                                            <td class=" text-center">{{ $product->quantity }}</td>
                                                        @endif

                                                        <td class="text-center">
                                                            <div class="row justify-content-center ">
                                                                <div>
                                                                    <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                                                                        class="btn btn-primary waves-effect waves-light">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </div>
                                                                <div>
                                                                    <form
                                                                        action="{{ route('admin.products.destroy', ['product' => $product->id]) }}"
                                                                        method="POST" onsubmit="return confirmDelete()">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger waves-effect waves-light">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center text-info">No products available
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page-body end -->
                </div>
                <div id="styleSelector"> </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-format').select2();
        });
    </script> --}}

    <script>
        document.getElementById('categorySelect').addEventListener('change', function() {
            var selectedCategory = this.value;
            var form = document.getElementById('categoryForm');
            if (selectedCategory == 'all') {
                form.action = '{{ route('admin.products.index') }}';
            } else {
                form.action = '{{ route('admin.products.byCategory', '') }}/' + selectedCategory;
            }
            form.submit(); // Tự động gửi form sau khi lựa chọn thay đổi
        });
    </script>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this product?');
        }
    </script>
@endsection
