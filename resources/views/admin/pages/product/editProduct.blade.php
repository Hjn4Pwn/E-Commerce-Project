@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeProducts' => 'active'])
    <div class="pcoded-content">
        <!-- Page-header start -->
        @include('admin.components.pageHeader', [
            'parentPage' => $parentPage,
            'childPage' => $childPage,
        ])
        <!-- Page-header end -->
        <div class="pcoded-inner-content">
            <!-- Main-body start -->
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- Page-body start -->
                    <div class="page-body">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Update Product</h5>
                                    </div>
                                    <div class="card-block">
                                        {{-- validation --}}
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @if ($product->count())
                                            <form method="POST"
                                                action="{{ route('admin.products.update', ['product' => $product->id]) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input name="name" type="text" class="form-control"
                                                            value="{{ $product->name }}">
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Select
                                                        Category</label>
                                                    <div class="col-sm-10">
                                                        <select name="categoryId" class="form-control select2-format"
                                                            style="width:100%;">
                                                            <option value="">Please select one</option>
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
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Upload
                                                        Image</label>
                                                    <div class="col-sm-2">
                                                        {{-- {{ asset('AdminResource/images/test/sampleProductImage.png') }} --}}
                                                        <img id="userImage" src="{{ asset($product->image) }}"
                                                            class="rounded-3" style="width: 100px; " alt="" />
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input name="image" type="file" class="form-control"
                                                            id="imageInput">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Price</label>
                                                    <div class="col-sm-10">
                                                        <input name="price" type="text" class="form-control"
                                                            maxlength="9" value="{{ $product->price }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Quantity</label>
                                                    <div class="col-sm-10">
                                                        <input name="quantity" type="text" class="form-control"
                                                            maxlength="9" value="{{ $product->quantity }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Describe</label>
                                                    <div class="col-sm-10">
                                                        <textarea id="editorTinyMCE" name="describe" rows="5" cols="5" class="form-control">
                                                            {!! $product->describe !!}
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="float-right">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">
                                                        Update
                                                    </button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-body end -->
        </div>
        <div id="styleSelector"> </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#imageInput').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#userImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>

    {{-- select2 --}}
    <script>
        $(document).ready(function() {
            $('.select2-format').select2();
        });
    </script>

    {{-- tinyMCE editor --}}
    @include('admin.components.tinymce_config')
@endsection
