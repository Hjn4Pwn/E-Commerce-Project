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
                                        <h5>Chỉnh sửa thông tin sản phẩm</h5>
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
                                                    <label class="col-sm-2 col-form-label">Tên</label>
                                                    <div class="col-sm-10">
                                                        <input name="name" type="text" class="form-control"
                                                            value="{{ $product->name }}">
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Danh mục</label>
                                                    <div class="col-sm-10">
                                                        <select name="category_id" class="form-control select2-format"
                                                            style="width:100%;">
                                                            <option value="">Chọn danh mục</option>
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
                                                                Ảnh chính
                                                            @else
                                                                Ảnh phụ {{ $image->sort_order }} (tùy chọn)
                                                            @endif

                                                        </label>
                                                        <div class="col-sm-2">
                                                            <img src="{{ Storage::disk('s3')->url($image->path) }}"
                                                                class="rounded-3 userImage"
                                                                id="image{{ $image->sort_order }}-preview"
                                                                style="width: 100px;" alt="" />
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input name="image{{ $image->sort_order }}" type="file"
                                                                class="form-control imageInput"
                                                                data-target="#image{{ $image->sort_order }}-preview">
                                                            @if ($image->sort_order != 1)
                                                                <div class="mt-2">
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-sm waves-effect waves-light cancel-button"
                                                                        onclick="deleteImage({{ $product->id }}, {{ $image->sort_order }})">Xóa</button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach


                                                @for ($i = $cntImage + 1; $i <= 4; $i++)
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Ảnh phụ {{ $i }}
                                                            (tùy chọn)</label>
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
                                                    <label class="col-sm-2 col-form-label">Khối lượng (gam)</label>
                                                    <div class="col-sm-10">
                                                        <input name="weight" type="text" class="form-control"
                                                            value="{{ $product->weight }}" maxlength="9">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Giá</label>
                                                    <div class="col-sm-10">
                                                        <input name="price" type="text" class="form-control"
                                                            maxlength="9" value="{{ $product->price }}">
                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Số lượng đã bán</label>
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
                                                    <label class="col-sm-2 col-form-label" for="flavors">Hương vị</label>
                                                    <div class="col-sm-10">
                                                        <div class="checkbox-container">
                                                            @foreach ($flavors as $flavor)
                                                                <div class="checkbox-item">
                                                                    <input type="checkbox" name="flavors[]"
                                                                        id="flavor_{{ $flavor['id'] }}"
                                                                        value="{{ $flavor['id'] }}"
                                                                        @if ($flavor['is_checked']) checked @endif
                                                                        class="flavor-checkbox">
                                                                    <label class="checkbox-item-label"
                                                                        for="flavor_{{ $flavor['id'] }}">{{ $flavor['name'] }}</label>
                                                                    <input type="number"
                                                                        value="{{ $flavor['quantity'] }}"
                                                                        name="flavor_quantities[{{ $flavor['id'] }}]"
                                                                        id="flavor_quantity_{{ $flavor['id'] }}"
                                                                        placeholder="Quantity"
                                                                        class="form-control flavor-quantity"
                                                                        style="display: none; margin-top: 5px; width:100px;"
                                                                        min="0"
                                                                        @if (!$flavor['is_checked']) disabled @endif>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Miêu tả ngắn</label>
                                                    <div class="col-sm-10">
                                                        <textarea id="editorTinyMCE_list" name="short_description" rows="3" cols="5" class="form-control"
                                                            placeholder="You should only input a list with a maximum of 10 options.">
                                                            {!! $product->short_description !!}
                                                        </textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Miêu tả</label>
                                                    <div class="col-sm-10">
                                                        <textarea id="editorTinyMCE" name="description" rows="5" cols="5" class="form-control">
                                                            {!! $product->description !!}
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="float-right">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">
                                                        Cập nhật
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

    <script>
        function deleteImage(productId, sortOrder) {
            if (confirm('Bạn có chắc chắn muốn xóa ảnh này không?')) {
                fetch(`/admin/products/${productId}/images/${sortOrder}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    return response.json().then(data => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert(data.error || 'Xóa ảnh thất bại.');
                        }
                    });
                }).catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                });
            }
        }
    </script>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Hiển thị các ô nhập liệu quantity nếu checkbox được kiểm tra khi trang được tải
            $('.flavor-checkbox').each(function() {
                var flavorId = $(this).attr('id').split('_')[1];
                if ($(this).is(':checked')) {
                    $('#flavor_quantity_' + flavorId).show().prop('disabled', false);
                }
            });

            // Hiển thị các ô nhập liệu quantity khi checkbox được thay đổi
            $('.flavor-checkbox').change(function() {
                var flavorId = $(this).attr('id').split('_')[1];
                if ($(this).is(':checked')) {
                    $('#flavor_quantity_' + flavorId).show().prop('disabled', false);
                } else {
                    $('#flavor_quantity_' + flavorId).hide().prop('disabled', true);
                }
            });

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
