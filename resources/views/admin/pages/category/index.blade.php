@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeCategories' => 'active'])
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
                                <h5>Danh sách các danh mục sản phẩm</h5>
                            </div>
                            <div class="card-block table-border-style">
                                <div class="p-30 p-b-0 p-t-0 text-right">
                                    <div class="col-sm-12">
                                        <a href="{{ route('admin.categories.create') }}">
                                            <button class="btn btn-info waves-effect waves-light">
                                                Thêm danh mục
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <div class="p-15 p-b-0">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form action="{{ route('admin.categories.index') }}" method="GET"
                                            class="form-material mt-2">
                                            <div class="form-group form-primary form-search">
                                                <input type="text" name="search" class="form-control"
                                                    value="{{ request('search') }}" placeholder=" ">
                                                <span class="form-bar"></span>
                                                <label class="float-label"><i class="fa fa-search m-r-10"></i> Tìm kiếm bằng
                                                    tên</label>
                                            </div>
                                        </form>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center" width="40%">Tên</th>
                                                <th class="text-center" width="20%">Số lượng sản phẩm</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($categories->count())
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <th class="text-center" scope="row">{{ ++$i }}</th>
                                                        <td class="text-center">{{ $category->name }}</td>
                                                        <td class="text-center">{{ $category->products->count() }}</td>
                                                        <td class="text-center">
                                                            <div class="row justify-content-center ">
                                                                <div>
                                                                    <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}"
                                                                        class="btn btn-primary waves-effect waves-light">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </div>
                                                                <div>
                                                                    <form
                                                                        action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}"
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
                                                    <td colspan="7" class="text-center text-info">Chưa có danh mục sản
                                                        phẩm nào. Hãy thêm mới.
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
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this category and its products?');
        }
    </script>
@endsection
