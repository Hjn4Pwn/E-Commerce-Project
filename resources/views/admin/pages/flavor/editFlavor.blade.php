@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeFlavors' => 'active'])
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
                                        <h5>Edit Flavor Name</h5>
                                        <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
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

                                        @if ($flavor->count())
                                            <form
                                                action="{{ route('admin.flavors.update', ['flavor' => $flavor->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Flavor Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ $flavor->name }}">
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
                    <!-- Page-body end -->
                </div>
                <div id="styleSelector"> </div>
            </div>
        </div>
    </div>
@endsection
