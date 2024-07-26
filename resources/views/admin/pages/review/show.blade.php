@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeReviews' => 'active'])
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
                                        <h5>Show Review</h5>
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

                                        @if ($reviewData->count())
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <div class="form-control-static text-dark pt-2">
                                                        {{ $reviewData->user->name }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Product Name</label>
                                                <div class="col-sm-10">
                                                    <div class="form-control-static text-dark pt-2">
                                                        {{ $reviewData->product->name }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Product Image</label>
                                                <div class="col-sm-10">
                                                    <img src="{{ asset($reviewData->product->main_image->path) }}"
                                                        class="rounded-3 userImage" style="width: 100px;" alt="" />
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Comment</label>
                                                <div class="col-sm-10">
                                                    <div class="form-control-static text-dark pt-2">
                                                        {{ $reviewData->comment }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Likes</label>
                                                <div class="col-sm-10">
                                                    <div class="form-control-static text-primary pt-2 font-weight-bold">
                                                        {{ $reviewData->total_likes }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Reports</label>
                                                <div class="col-sm-10">
                                                    <div class="form-control-static text-danger pt-2 font-weight-bold">
                                                        {{ $reviewData->total_reports }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="float-right">
                                                <form
                                                    action="{{ route('admin.reviews.destroy', ['review' => $reviewData->id]) }}"
                                                    method="POST" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger waves-effect waves-light">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
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
        function confirmDelete() {
            return confirm('Are you sure you want to delete this review?');
        }
    </script>
@endsection