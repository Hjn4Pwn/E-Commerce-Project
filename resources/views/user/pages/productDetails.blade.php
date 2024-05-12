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

                    <div class="row justify-content-center">
                        <div class="col-md-10 bg-white p-5">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex justify-content-center ">
                                    <div class="product-imgs">
                                        <div class="haiz">
                                            <div class="img-display">
                                                <div class="img-showcase">
                                                    <img src="{{ asset('AdminResource/images/test/sampleProductImage.png') }}"
                                                        alt="Product Image 1" class="product-img">
                                                    <img src="{{ asset('AdminResource/images/test/sampleProductImage.png') }}"
                                                        alt="Product Image 2" class="product-img">
                                                    <img src="{{ asset('AdminResource/images/test/sampleProductImage.png') }}"
                                                        alt="Product Image 3" class="product-img">
                                                    <img src="{{ asset('AdminResource/images/test/sampleProductImage.png') }}"
                                                        alt="Product Image 4" class="product-img">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="img-select">
                                            <div class="img-item">
                                                <a href="#" data-id="1" class="">
                                                    <img src="{{ asset('AdminResource/images/test/sampleProductImage.png') }}"
                                                        alt="Product Thumbnail 1" class="product-img active">
                                                </a>
                                            </div>
                                            <div class="img-item">
                                                <a href="#" data-id="2">
                                                    <img src="{{ asset('AdminResource/images/test/sampleProductImage.png') }}"
                                                        alt="Product Thumbnail 2" class="product-img">
                                                </a>
                                            </div>
                                            <div class="img-item">
                                                <a href="#" data-id="3">
                                                    <img src="{{ asset('AdminResource/images/test/sampleProductImage.png') }}"
                                                        alt="Product Thumbnail 3" class="product-img">
                                                </a>
                                            </div>
                                            <div class="img-item">
                                                <a href="#" data-id="4">
                                                    <img src="{{ asset('AdminResource/images/test/sampleProductImage.png') }}"
                                                        alt="Product Thumbnail 4" class="product-img">
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <h2 class="mb-3 mt-3">Ostrovit Creatine Monohydrate 500g</h2>
                                    <div class="mb-3">
                                        {{-- <div class="star-rating">
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <span class="text-info">(Xem 4 đánh giá)</span>
                                        </div> --}}
                                        <div class="d-flex align-items-center">
                                            <div class="star-ratings">
                                                <div class="fill-ratings" style="width: 86%;">
                                                    <!-- Giả sử muốn hiển thị 4.3 sao, set width là 86% -->
                                                    <span>★★★★★</span>
                                                </div>
                                                <div class="empty-ratings">
                                                    <span>★★★★★</span>
                                                </div>
                                            </div>
                                            <a href="#product-rating" style="text-decoration: none;">
                                                <span class="text-info ml-3">(Xem 4 đánh giá)</span>
                                            </a>
                                        </div>


                                    </div>
                                    <div style="display: flex; align-items: center;">
                                        <h4 class="mr-3 mb-0">590.000₫</h4>
                                        <h4 class="mr-3 mb-0" style="color: #6c757d; font-size:16px;">
                                            <del>737.500₫</del>
                                        </h4>
                                        <span class="badge badge-danger" style="font-size: 18px;">-20%</span>
                                    </div>
                                    <div>
                                        <span>Tiết kiệm </span> <span class="text-danger">147.500₫</span>
                                    </div>


                                    <ul class="mt-4 custom-ul-original">
                                        <li class="mb-2">3000mg Creatine Monohydrate</li>
                                        <li class="mb-2">2640mg of which Creatine</li>
                                        <li class="mb-2">Tốt cho việc phát triển cơ bắp</li>
                                        <li class="mb-2">Tăng cường sức bền tập luyện</li>
                                        <li class="mb-2">Gia tăng hiệu suất tập luyện</li>
                                    </ul>
                                    <div>
                                        <span>Hương vị:</span>
                                        <div class="form-check ml-5">
                                            <input class="form-check-input" type="radio" name="exampleRadios"
                                                id="exampleRadios1" value="option1" checked>
                                            <label class="form-check-label" for="exampleRadios1">
                                                Mango
                                            </label>
                                        </div>
                                        <div class="form-check ml-5">
                                            <input class="form-check-input" type="radio" name="exampleRadios"
                                                id="exampleRadios2" value="option2">
                                            <label class="form-check-label" for="exampleRadios2">
                                                Cherry
                                            </label>
                                        </div>
                                        <div class="form-check ml-5">
                                            <input class="form-check-input" type="radio" name="exampleRadios"
                                                id="exampleRadios3" value="option3">
                                            <label class="form-check-label" for="exampleRadios3">
                                                Unflavoured
                                            </label>
                                        </div>
                                        <div class="form-check ml-5">
                                            <input class="form-check-input" type="radio" name="exampleRadios"
                                                id="exampleRadios4" value="option4">
                                            <label class="form-check-label" for="exampleRadios4">
                                                Lemon
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mt-5 mb-5">
                                        <label class="mr-3">Số lượng:</label>
                                        <input type="number" class="text-center w-25" value="1" min="1">

                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary">Add to Cart</button>
                                        <button class="btn btn-success">Buy Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3"></div>

                    <div class="row justify-content-center">
                        <div class="col-md-10 bg-white p-5">
                            <h5>MÔ TẢ SẢN PHẨM</h5>
                            <div class="content" id="moreText" style="overflow:hidden; height: 100px;">
                                Ostrovit Creatine là sản phẩm cung cấp Creatine Monohydrate tinh khiết nhất của nhà
                                Ostrovit cho tới thời điểm hiện tại. Với sự cải tiến vượt bậc khi áp dụng công thức, mẫu
                                mã mới đi kèm với đó là những cái chất rất riêng mà chỉ Ostrovit Creatine có được như:
                                Đa dạng về hương vị và giá thành dễ tiếp cận, chắc chắn Ostrovit Creatine là một trong
                                dòng Creatine tốt, được nhiều tin tưởng sử dụng nhất hiện nay.

                                OSTROVIT CREATINE - DIỆN MẠO MỚI, CÔNG THỨC MỚI


                                Một trong những dòng Creatine giá rẻ, phù hợp với đại đa số người tập luyện, đồng thời
                                đem lại nhiều lựa chọn về kích thước, mùi vị thì chắc chắn không thể không nhắc đến
                                Ostrovit Creatine Monohydrate.



                                Ostrovit Creatine cung cấp 3 gram Creatine Monohydrate qua mỗi Serving. Theo khuyến cáo,
                                liều lượng cho một người tập luyện bình thường chỉ cần cung cấp 3 - 5g Creatine
                                Monohydrate mỗi ngày là đủ để kích thích khả năng tổng hợp Protein, đồng thời cải thiện
                                sức bền trong tập luyện, phát triển cơ bắp một cách hiệu quả.



                                VỀ THƯƠNG HIỆU OSTROVIT


                                Tại Ba Lan, Ostrovit Nutrition là hãng thực phẩm bổ sung chuyên cung cấp các sản phẩm hỗ
                                trợ tập luyện, dinh dưỡng và đời sống hàng ngày số 1 tại Ba Lan. Một trong những lý do
                                bạn có thể lựa chọn các sản phẩm của hãng Ostrovit như:



                                1. Sản phẩm chất lượng cao: Ưu tiên của hãng Ostrovit là tạo ra những sản phẩm đáp ứng
                                mong đợi của khách hàng, đây cũng chính là lý do tại sao các sản phẩm của Ostrovit sẽ hỗ
                                trợ rất tốt trong quá trình tập luyện, dinh dưỡng.



                                2. Thành phần được kiểm đỉnh: Sản phẩm của Ostrovit được thử nghiệm các sản phẩm của
                                hãng trong các phòng thí nghiệm độc lập và được công nhận. Chắc chắn và đảm bảo rằng
                                những gì thành phần ghi ở trên nhãn là đúng 100%.



                                3. Giá thành tốt nhất: Hiện nay, hãng Ostrovit là một trong những hãng thực phẩm bổ sung
                                có giá thành tốt nhất trên thị trường nhưng vẫn luôn cam kết khẳng định chất lượng cao
                                của hãng Ostrovit.



                                => Tham khảo thêm các sản phẩm cũng hãng: Ostrovit



                                VỀ CREATINE MONOHYDRATE


                                Creatine là một trong những chất bổ sung phổ biến có được nghiên cứu nhất từ trước cho
                                tới nay về độ an toàn, tính khả dụng, công dụng trong cuộc sống hàng ngày và tác dụng
                                trong việc tập luyện.



                                Creatine là một chất được tìm thấy tự nhiên trong bế bào cơ, đồng thời cơ thể cũng có
                                thể tự tổng hợp và sản sinh ra được Creatine.



                                Creatine cung cấp năng lượng có tên ATP giúp cơ bắp hoạt động hiệu quả.



                                Với 95% Creatine trong cơ thể được lưu trữ trong cơ bắp, khi bạn bổ sung thêm Creatine
                                sẽ giúp gia tăng lượng dự trữ phosphocreatine. Việc này sẽ giúp cơ thể bạn sản xuất
                                nhiều adenosine triphosphate (ATP) đây như là một dạng tiền tệ của cơ thể, nếu bạn muốn
                                tập luyện ở cường độ cao hơn bạn sẽ cần phải có nhiều ATP hơn trong cơ thể. Và đó cũng
                                chính là lý do tại sao bạn nên bổ sung thêm Creatine.
                            </div>
                            <button id="expandBtn" class="btn btn-info mt-2 w-100"><i
                                    class="fa-solid fa-plus mr-2"></i>Xem thêm</button>
                            <button id="collapseBtn" class="btn btn-info mt-2 w-100" style="display:none;"><i
                                    class="fa-solid fa-minus mr-2"></i>Thu
                                gọn</button>
                        </div>
                    </div>

                    <div class="row mt-3"></div>

                    <div class="row justify-content-center" id="product-rating">
                        <div class="col-md-10 bg-white pt-5 pr-5 pl-5 pb-2">
                            <h5>ĐÁNH GIÁ SẢN PHẨM</h5>
                            {{-- <div class="rating">
                                <input type="radio" name="rating" value="5" id="5"><label
                                    for="5">☆</label>
                                <input type="radio" name="rating" value="4" id="4"><label
                                    for="4">☆</label>
                                <input type="radio" name="rating" value="3" id="3"><label
                                    for="3">☆</label>
                                <input type="radio" name="rating" value="2" id="2"><label
                                    for="2">☆</label>
                                <input type="radio" name="rating" value="1" id="1"><label
                                    for="1">☆</label>
                            </div> --}}
                            <div class="header-rating row pt-3 pb-3">
                                <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                    <div class="text-center">
                                        <span class="text-danger mb-3  f-30">4.9/5</span>
                                    </div>
                                    <div class="star-center">
                                        <div class="star-ratings">
                                            <div class="fill-ratings" style="width: 86%;">
                                                <!-- Giả sử muốn hiển thị 4.3 sao, set width là 86% -->
                                                <span>★★★★★</span>
                                            </div>
                                            <div class="empty-ratings">
                                                <span>★★★★★</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <span class="mb-3 f-18">(2 đánh giá)</span>
                                    </div>

                                    <div class="mt-4 mb-4 text-center">
                                        <button type="button" class="btn btn-primary">Đánh giá</button>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                                    <button type="button" class="btn bg-white mr-3 mb-2">Tất cả</button>
                                    <button type="button" class="btn bg-white mr-3 mb-2">5 sao (2.4k)</button>
                                    <button type="button" class="btn bg-white mr-3 mb-2">4 sao (80)</button>
                                    <button type="button" class="btn bg-white mr-3 mb-2">3 sao (22)</button>
                                    <button type="button" class="btn bg-white mr-3 mb-2">1 sao (10)</button>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="per-rating mb-5">
                                    <div class="d-flex align-items-center">
                                        <span class="font-weight-bold mr-2">Huy Na</span>
                                        <div class="star-ratings">
                                            <div class="fill-ratings f-18" style="width: 86%;">
                                                <!-- Giả sử muốn hiển thị 4.3 sao, set width là 86% -->
                                                <span>★★★★★</span>
                                            </div>
                                            <div class="empty-ratings f-18">
                                                <span>★★★★★</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2">
                                        Xin hỏi dùng có bị mất ngủ ko ạ?
                                    </div>
                                    <div>
                                        <ul class="list-unstyled d-flex align-items-center mb-0 comment-actions">
                                            <li class="comment-actions__item mr-3 ">
                                                <a href="#" class="comment-actions__link"
                                                    onclick="toggleLike(this);">
                                                    <i
                                                        class="fa-solid fa-thumbs-up comment-actions__icon comment-actions__icon-like"></i>
                                                    <span class="comment-actions__text f-16">0</span>
                                                    <span class="comment-actions__text f-16">Hữu ích</span>
                                                </a>

                                            </li>
                                            <li class="comment-actions__item mr-3">
                                                <a href="#" class="comment-actions__link">
                                                    <i
                                                        class="fa-solid fa-triangle-exclamation comment-actions__icon comment-actions__icon-report "></i>
                                                    <span
                                                        class="comment-actions__text comment-actions__text-report f-16">Báo
                                                        cáo</span>
                                                </a>
                                            </li>
                                            <li class="comment-actions__item mr-3">
                                                <span class="comment-actions__time f-16">17:16 14/06/2023</span>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <div class="per-rating mb-5">
                                    <div class="d-flex align-items-center">
                                        <span class="font-weight-bold mr-2">Huy Na</span>
                                        <div class="star-ratings">
                                            <div class="fill-ratings f-18" style="width: 86%;">
                                                <!-- Giả sử muốn hiển thị 4.3 sao, set width là 86% -->
                                                <span>★★★★★</span>
                                            </div>
                                            <div class="empty-ratings f-18">
                                                <span>★★★★★</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2">
                                        Ostrovit Creatine là sản phẩm cung cấp Creatine Monohydrate tinh khiết nhất của nhà
                                        Ostrovit cho tới thời điểm hiện tại. Với sự cải tiến vượt bậc khi áp dụng công thức,
                                        mẫu
                                        mã mới đi kèm với đó là những cái chất rất riêng mà chỉ Ostrovit Creatine có được
                                        như:
                                        Đa dạng về hương vị và giá thành dễ tiếp cận, chắc chắn Ostrovit Creatine là một
                                        trong
                                        dòng Creatine tốt, được nhiều tin tưởng sử dụng nhất hiện nay.
                                    </div>
                                    <div>
                                        <ul class="list-unstyled d-flex align-items-center mb-0 comment-actions">
                                            <li class="comment-actions__item mr-3 ">
                                                <a href="#" class="comment-actions__link"
                                                    onclick="toggleLike(this);">
                                                    <i
                                                        class="fa-solid fa-thumbs-up comment-actions__icon comment-actions__icon-like"></i>
                                                    <span class="comment-actions__text f-16">5</span>
                                                    <span class="comment-actions__text f-16">Hữu ích</span>
                                                </a>

                                            </li>
                                            <li class="comment-actions__item mr-3">
                                                <a href="#" class="comment-actions__link">
                                                    <i
                                                        class="fa-solid fa-triangle-exclamation comment-actions__icon comment-actions__icon-report "></i>
                                                    <span
                                                        class="comment-actions__text comment-actions__text-report f-16">Báo
                                                        cáo</span>
                                                </a>
                                            </li>
                                            <li class="comment-actions__item mr-3">
                                                <span class="comment-actions__time f-16">17:16 14/06/2023</span>
                                            </li>
                                        </ul>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Page-body end -->
        <div class="mb-5"></div>
    </div>

    {{-- rating star --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var star_rating_width = $('.fill-ratings span').width();
            $('.star-ratings').width(star_rating_width);
        });
    </script>

    {{-- active product image --}}
    <script>
        document.querySelectorAll('.img-item a').forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault();

                // Xóa class 'active' khỏi tất cả các hình ảnh
                document.querySelectorAll('.img-item img').forEach(img => {
                    img.classList.remove('active');
                });

                // Thêm class 'active' cho hình ảnh được nhấp vào
                const img = item.querySelector('img');
                img.classList.add('active');

                // Cập nhật hình ảnh hiển thị chính
                const displayImage = document.querySelector('.img-showcase img');
                displayImage.src = img.src;
                displayImage.alt = img.alt;

                // Đặt lại và chạy hàm slideImage với ID mới
                const imgId = parseInt(item.getAttribute('data-id'));
                slideImage(imgId);
            });
        });

        function slideImage(imgId) {
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;
            document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
        }

        window.addEventListener('resize', function() {
            const activeImgId = document.querySelector('.img-item img.active').parentNode.getAttribute('data-id');
            slideImage(parseInt(activeImgId));
        });
    </script>

    {{-- xem thêm - thu gọn description  --}}
    <script>
        document.getElementById('expandBtn').addEventListener('click', function() {
            // Mở rộng nội dung
            document.getElementById('moreText').style.height = 'auto';
            // Ẩn nút Xem thêm và hiển thị nút Thu gọn
            document.getElementById('expandBtn').style.display = 'none';
            document.getElementById('collapseBtn').style.display = 'inline';
        });

        document.getElementById('collapseBtn').addEventListener('click', function() {
            // Thu gọn nội dung
            document.getElementById('moreText').style.height = '100px';
            // Hiển thị nút Xem thêm và ẩn nút Thu gọn
            document.getElementById('expandBtn').style.display = 'inline';
            document.getElementById('collapseBtn').style.display = 'none';
        });
    </script>

    {{-- btn active --}}
    <script>
        $(document).ready(function() {
            $('.btn').on('click', function() {
                $('.btn').removeClass('btn-active');
                $('.btn').removeClass('text-primary');
                $(this).addClass('btn-active');
                $(this).addClass('text-primary');
            });
        });
    </script>

    {{-- action like --}}
    <script>
        document.querySelectorAll('.comment-actions__item:nth-child(1) .comment-actions__link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Chặn sự kiện mặc định
                var icon = this.querySelector('.comment-actions__icon');
                icon.style.color = (icon.style.color === 'rgb(0, 123, 255)' ? 'gray' :
                    '#007bff'); // Toggle màu sắc
            });
        });

        function toggleLike(element) {
            element.classList.toggle('liked');
        }
    </script>
@endsection
