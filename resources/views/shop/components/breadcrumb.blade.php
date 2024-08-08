<div class="row justify-content-center no-select">
    <div class="col-md-10 p-0">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="f-18 link_none">Trang chủ</a></li>
                {{-- <li class="breadcrumb-item"><a href="#">Library</a></li> --}}
                <li class="breadcrumb-item active f-18" aria-current="page">{{ $subpage ?? '' }}</li>
            </ol>
        </nav>
    </div>
</div>
