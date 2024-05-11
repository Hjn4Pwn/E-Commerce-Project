@extends('user.layout')

@section('content')
    {{-- @include('user.components.navbar') --}}
    @include('user.components.pageHeader')

    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    {{-- slider --}}
                    @include('user.components.slider')
                    {{-- ---- --}}
                    <div class="prod-by-category">
                        <div>
                            <span>Creatine</span>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div>
                                        <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up
                                                the bulk of the card's content.</p>
                                            <div class="text-right">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div>
                                        <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up
                                                the bulk of the card's content.</p>
                                            <div class="text-right">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div>
                                        <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up
                                                the bulk of the card's content.</p>
                                            <div class="text-right">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div>
                                        <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up
                                                the bulk of the card's content.</p>
                                            <div class="text-right">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div>
                                        <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up
                                                the bulk of the card's content.</p>
                                            <div class="text-right">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div>
                                        <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up
                                                the bulk of the card's content.</p>
                                            <div class="text-right">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div>
                                        <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make up
                                                the bulk of the card's content.</p>
                                            <div class="text-right">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div>
                                        <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make up
                                                the bulk of the card's content.</p>
                                            <div class="text-right">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-b-30">
                                <div class="card mx-auto product-card">
                                    <div>
                                        <img src={{ asset('AdminResource/images/test/sampleProductImage.png') }}
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make up
                                                the bulk of the card's content.</p>
                                            <div class="text-right">
                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-body end -->
    </div>
@endsection
