@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeProducts' => 'active'])
    <div class="pcoded-content">
        @include('admin.components.pageHeader', ['page' => $page])
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="card">
                            <div class="card-header">
                                <h5>Danh sách sản phẩm</h5>
                                <div class="card-header-right">
                                </div>
                            </div>

                            <div class="card-block table-border-style">
                                <div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-30 p-b-0 p-t-0">
                                    <form class="form-material float-right" action="{{ route('admin.products.create') }}"
                                        method="get">
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Thêm sản
                                                phẩm</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="p-30 p-b-0 p-t-0">

                                    <form class="form-material" method="get" action="" id="categoryForm">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Chọn danh mục</label>
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
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <div class="p-15 p-b-0">
                                        <form action="{{ route('admin.products.index') }}" method="GET"
                                            class="form-material mt-2">
                                            <div class="form-group form-primary form-search">
                                                <input type="text" name="search" class="form-control"
                                                    value="{{ request('search') }}" placeholder=" ">
                                                <span class="form-bar"></span>
                                                <label class="float-label"><i class="fa fa-search m-r-10"></i>Tìm kiếm bằng
                                                    tên</label>
                                            </div>
                                        </form>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center" width=20%>Tên </th>
                                                <th class="text-center" width=15%>Ảnh</th>
                                                <th class="text-center" width=15%>Danh mục</th>
                                                <th class="text-center" width=15%>Giá</th>
                                                <th class="text-center" width=15%>Số lượng</th>
                                                <th class="text-center">Hành động</th>
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
                                                        <td class="text-center">{{ $product->name }}</td>
                                                        <td class="text-center p-t-5"><img
                                                                src="{{ asset($product->main_image->path) }}"
                                                                class="rounded-3" style="width: 100px;"
                                                                alt="Product Image" /></td>
                                                        <td class="text-center">{{ $product->category->name }}</td>
                                                        <td class="text-center">{{ format_currency($product->price) }}</td>
                                                        @if ($outOfStockProducts->contains($product->id))
                                                            <td class="text-center">Hết hàng</td>
                                                        @else
                                                            <td class="text-center">{{ $product->quantity }}</td>
                                                        @endif
                                                        <td class="text-center">
                                                            <div class="row justify-content-center">
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
                                                    <td colspan="7" class="text-center text-info">Chưa có sản phẩm nào.
                                                        Hãy thêm mới.
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="styleSelector"> </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('categorySelect').addEventListener('change', function() {
            var selectedCategory = this.value;
            var form = document.getElementById('categoryForm');
            if (selectedCategory == 'all') {
                form.action = '{{ route('admin.products.index') }}';
            } else {
                form.action = '{{ route('admin.products.byCategory', '') }}/' + selectedCategory;
            }
            form.submit(); // Automatically submit the form after changing the selection
        });

        function confirmDelete() {
            return confirm('Are you sure you want to delete this product?');
        }
    </script>
@endsection
