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
                                                    <label class="col-sm-2 col-form-label">Category</label>
                                                    <div class="col-sm-10">
                                                        <select name="category_id" class="form-control select2-format"
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

                                                @php
                                                    $cntImage = 0;
                                                @endphp
                                                @foreach ($images as $image)
                                                    <div class="form-group row">
                                                        @php
                                                            ++$cntImage;
                                                        @endphp
                                                        <label class="col-sm-2 col-form-label">
                                                            @if ($image->sort_order == 1)
                                                                Primary Image
                                                            @else
                                                                Image {{ $image->sort_order }} (Optional)
                                                            @endif

                                                        </label>
                                                        <div class="col-sm-2">
                                                            <img src="{{ asset($image->path) }}" class="rounded-3 userImage"
                                                                id="image{{ $image->sort_order }}-preview"
                                                                style="width: 100px;" alt="" />
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input name="image{{ $image->sort_order }}" type="file"
                                                                class="form-control imageInput"
                                                                data-target="#image{{ $image->sort_order }}-preview">
                                                        </div>
                                                    </div>
                                                @endforeach

                                                @for ($i = $cntImage + 1; $i <= 4; $i++)
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Image {{ $i }}
                                                            (Optional)</label>
                                                        <div class="col-sm-2">
                                                            <img src="" class="rounded-3 userImage"
                                                                id="image{{ $i }}-preview" style="width: 100px;"
                                                                alt="" />
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input name="image{{ $i }}" type="file"
                                                                class="form-control imageInput"
                                                                data-target="#image{{ $i }}-preview">
                                                        </div>
                                                    </div>
                                                @endfor


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
                                                    <label class="col-sm-2 col-form-label">Quantity Sold</label>
                                                    <div class="col-sm-10">
                                                        <input name="quantity_sold" type="text" class="form-control"
                                                            value="{{ $product->quantity_sold }}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Sale (%)</label>
                                                    <div class="col-sm-10">
                                                        <input name="sale" type="text" class="form-control"
                                                            value="{{ $product->sale }}" maxlength="9">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="flavors">Flavors</label>
                                                    <div class="col-sm-10">
                                                        <div class="checkbox-container">
                                                            @foreach ($flavors as $flavor)
                                                                <div class="checkbox-item">
                                                                    <input type="checkbox" name="flavors[]"
                                                                        id="flavor_{{ $flavor['id'] }}"
                                                                        value="{{ $flavor['id'] }}"
                                                                        @if ($flavor['is_checked']) checked @endif>
                                                                    <label class="checkbox-item-label"
                                                                        for="flavor_{{ $flavor['id'] }}">{{ $flavor['name'] }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Short Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea id="editorTinyMCE_list" name="short_description" rows="3" cols="5" class="form-control"
                                                            placeholder="You should only input a list with a maximum of 10 options.">
                                                            {!! $product->short_description !!}
                                                        </textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea id="editorTinyMCE" name="description" rows="5" cols="5" class="form-control">
                                                            {!! $product->description !!}
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
            $('.imageInput').change(function(e) {
                var reader = new FileReader();
                var target = $(this).data('target');
                reader.onload = function(e) {
                    $(target).attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
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
