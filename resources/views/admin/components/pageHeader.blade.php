<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">{{ $page ?? ($parentPage[0] ?? '') }}</h5>
                    <p class="m-b-0">Chào mừng bạn đến trang Admin</p>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"> <i class="fa fa-home"></i> </a>
                    </li>
                    @if (isset($parentPage))
                        <li class="breadcrumb-item"><a href="{{ route($parentPage[1]) }}">{{ $parentPage[0] }}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">{{ $childPage }}</a>
                        </li>
                    @else
                        <li class="breadcrumb-item"><a href="#!">{{ $page ?? '' }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
