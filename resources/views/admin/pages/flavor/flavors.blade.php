@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeFlavors' => 'active'])
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
                                <h5>List of Flavors</h5>
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
                                <div class="p-30 p-b-0 p-t-0 text-right">
                                    <div class="col-sm-12">
                                        <a href="{{ route('admin.flavors.create') }}">
                                            <button class="btn btn-info waves-effect waves-light">
                                                Add Flavor
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
                                                <th class="text-center" width="40%">Name</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($flavors->count())
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($flavors as $flavor)
                                                    <tr>
                                                        <th class="text-center" scope="row">{{ ++$i }}</th>
                                                        <td class="text-center">{{ $flavor->name }}</td>
                                                        <td class="text-center">
                                                            <div class="row justify-content-center ">
                                                                <div>
                                                                    <a href="{{ route('admin.flavors.edit', ['flavor' => $flavor->id]) }}"
                                                                        class="btn btn-primary waves-effect waves-light">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </div>
                                                                <div>
                                                                    <form
                                                                        action="{{ route('admin.flavors.destroy', ['flavor' => $flavor->id]) }}"
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
                                                    <td colspan="7" class="text-center text-info">No flavors available
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
            return confirm('Are you sure you want to delete this flavor?');
        }
    </script>
@endsection
