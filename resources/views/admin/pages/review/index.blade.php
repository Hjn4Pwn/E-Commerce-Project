@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeReviews' => 'active'])
    <div class="pcoded-content">
        @include('admin.components.pageHeader', ['page' => $page])
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="card">
                            <div class="card-header">
                                <h5>List of Reviews</h5>
                                <div class="card-header-right">
                                </div>
                            </div>
                            <div class="card-block table-border-style">
                                
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
                                       
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center" width="30%">Name</th>
                                                <th class="text-center" width="20%">Likes</th>
                                                <th class="text-center" width="20%">Reports</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($reviews->count())
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($reviews as $review)
                                                    <tr>
                                                        <th class="text-center" scope="row">{{ ++$i }}</th>
                                                        <td class="text-center">{{ $review->user->name }}</td>
                                                        <td class="text-center text-primary font-weight-bold">
                                                            {{ $review->total_likes }}</td>
                                                        <td class="text-center text-danger font-weight-bold">
                                                            {{ $review->total_reports }}</td>
                                                        <td class="text-center">
                                                            <div class="row justify-content-center ">
                                                                <div>
                                                                    <a href="{{ route('admin.reviews.show', ['review' => $review->id]) }}"
                                                                        class="btn btn-info waves-effect waves-light">
                                                                        <i class="fa-solid fa-eye"></i>
                                                                    </a>
                                                                </div>
                                                                <div>
                                                                    <form
                                                                        action="{{ route('admin.reviews.destroy', ['review' => $review->id]) }}"
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
                                                    <td colspan="7" class="text-center text-info">No reviews available
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                    <div class="row justify-content-center">
                                        {{ $reviews->links() }}
                                    </div>
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
            return confirm('Are you sure you want to delete this review?');
        }
    </script>
@endsection
