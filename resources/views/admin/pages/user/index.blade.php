@extends('admin.layout')

@section('content')
    @include('admin.components.navbar', ['activeUsers' => 'active'])
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
                                <h5>List of Users</h5>
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
                                <div class="table-responsive">
                                    <div class="p-15 p-b-0">
                                        <form action="{{ route('admin.users.index') }}" method="GET"
                                            class="form-material mt-2">
                                            <div class="form-group form-primary form-search">
                                                <input type="text" name="search" class="form-control"
                                                    value="{{ request('search') }}" placeholder=" ">
                                                <span class="form-bar"></span>
                                                <label class="float-label"><i class="fa fa-search m-r-10"></i> Search by
                                                    Name</label>
                                            </div>
                                        </form>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Phone</th>
                                                <th class="text-center">Address</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($users->count())
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <th class="lh40 text-center" scope="row">{{ ++$i }}</th>
                                                        <td class="lh40 text-center">{{ $user->name }}</td>
                                                        <td class="lh40 text-center">{{ $user->email }}</td>
                                                        <td class="lh40 text-center">{{ $user->phone }}</td>
                                                        <td class="lh40 text-center">
                                                            @if ($user->ward)
                                                                {{ $user->address_detail . ', ' . $user->ward->name . ', ' . $user->district->name . ', ' . $user->province->name }}
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="row justify-content-center">
                                                                {{-- view user info detail --}}
                                                                <div>
                                                                    <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                                                        class="btn btn-primary waves-effect waves-light">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </div>
                                                                {{-- delete by user id --}}
                                                                <div>
                                                                    <form
                                                                        action="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
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
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- pagination --}}
                        <div class="row justify-content-center">
                            {{ $users->links() }}
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
            return confirm('Are you sure you want to delete this user?');
        }
    </script>

@endsection
