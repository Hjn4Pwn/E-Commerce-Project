@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeSliders' => 'active'])
    <div class="pcoded-content">
        @include('admin.components.pageHeader', ['page' => $page])
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="card">
                            <div class="card-header">
                                <h5>Danh sách các Sliders</h5>
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
                                <div class="p-30 mb-5 p-t-0">
                                    <form class="form-material float-right" action="{{ route('admin.sliders.create') }}"
                                        method="get">
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Thêm
                                                slider</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="table-responsive">

                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center" width=20%>Tiêu đề</th>
                                                <th class="text-center" width=60%>Ảnh</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($sliders->count())
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($sliders as $slider)
                                                    <tr>
                                                        <th class="text-center" scope="row">{{ ++$i }}</th>
                                                        <td class="text-center">{{ $slider->title }}</td>
                                                        <td class="text-center p-t-5"><img
                                                                src="{{ Storage::disk('s3')->url($slider->image_path) }}"
                                                                class="rounded-3" style="width: 300px;"
                                                                alt="Product Image" /></td>

                                                        <td class="text-center">
                                                            <div class="row justify-content-center">
                                                                <form
                                                                    action="{{ route('admin.sliders.destroy', ['slider' => $slider->id]) }}"
                                                                    method="POST" onsubmit="return confirmDelete()">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger waves-effect waves-light">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center text-info">Chưa có slider nào. Hãy
                                                        thêm mới.
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
        function confirmDelete() {
            return confirm('Are you sure you want to delete this slider?');
        }
    </script>
@endsection
