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
                                        <h5>Add Product</h5>
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
                                        <form method="POST" action="{{ route('admin.products.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input name="name" type="text" placeholder="Enter product name..."
                                                        class="form-control">
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
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- product Image --}}
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Primary Image</label>
                                                <div class="col-sm-2">
                                                    <img src="" class="rounded-3 userImage" id="image1-preview"
                                                        style="width: 100px;" alt="" />
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="image1" type="file" class="form-control imageInput"
                                                        data-target="#image1-preview">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Image 2 (Optional)</label>
                                                <div class="col-sm-2">
                                                    <img src="" class="rounded-3 userImage" id="image2-preview"
                                                        style="width: 100px;" alt="" />
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="image2" type="file" class="form-control imageInput"
                                                        data-target="#image2-preview">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Image 3 (Optional)</label>
                                                <div class="col-sm-2">
                                                    <img src="" class="rounded-3 userImage" id="image3-preview"
                                                        style="width: 100px;" alt="" />
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="image3" type="file" class="form-control imageInput"
                                                        data-target="#image3-preview">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Image 4 (Optional)</label>
                                                <div class="col-sm-2">
                                                    <img src="" class="rounded-3 userImage" id="image4-preview"
                                                        style="width: 100px;" alt="" />
                                                </div>
                                                <div class="col-sm-8">
                                                    <input name="image4" type="file" class="form-control imageInput"
                                                        data-target="#image4-preview">
                                                </div>
                                            </div>

                                            {{-- ------------- --}}
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Price</label>
                                                <div class="col-sm-10">
                                                    <input name="price" type="text" class="form-control"
                                                        placeholder="Ex: 900000000 (max 9 digits)" maxlength="9">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Quantity Sold</label>
                                                <div class="col-sm-10">
                                                    <input name="quantity_sold" type="text" class="form-control"
                                                        value="0" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Sale (%)</label>
                                                <div class="col-sm-10">
                                                    <input name="sale" type="text" class="form-control"
                                                        value="0" maxlength="9">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="flavors">Flavors</label>
                                                <div class="col-sm-10">
                                                    <div class="checkbox-container ">
                                                        @foreach ($flavors as $flavor)
                                                            <div class="checkbox-item">
                                                                <input type="checkbox" name="flavors[]"
                                                                    id="flavor_{{ $flavor->id }}"
                                                                    value="{{ $flavor->id }}" class="flavor-checkbox">
                                                                <label class="checkbox-item-label"
                                                                    for="flavor_{{ $flavor->id }}">{{ $flavor->name }}</label>
                                                                <input type="number"
                                                                    name="flavor_quantities[{{ $flavor->id }}]"
                                                                    id="flavor_quantity_{{ $flavor->id }}"
                                                                    placeholder="Quantity"
                                                                    class="form-control flavor-quantity"
                                                                    style="display:none; margin-top: 5px; width:100px;">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Short Description</label>
                                                <div class="col-sm-10">
                                                    <textarea id="editorTinyMCE_list" name="short_description" rows="3" cols="5" class="form-control"
                                                        placeholder="Just enter one list, max ten"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-10">
                                                    <textarea id="editorTinyMCE" name="description" rows="5" cols="5" class="form-control"
                                                        placeholder="Typing ..."></textarea>
                                                </div>
                                            </div>

                                            <div class="float-right">
                                                <button type="submit" class="btn btn-info waves-effect waves-light">
                                                    Add Product
                                                </button>
                                            </div>
                                        </form>
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

            // Handle flavor quantity input display
            $('.flavor-checkbox').change(function() {
                var flavorId = $(this).attr('id').split('_')[1];
                if ($(this).is(':checked')) {
                    $('#flavor_quantity_' + flavorId).show();
                } else {
                    $('#flavor_quantity_' + flavorId).hide();
                }
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
