# Demo: [Video link](https://drive.google.com/file/d/1yFMK5rJWZNd8IRyEUUgATbZLTrBNCQj0/view?usp=drive_link)

- [Công nghệ sử dụng](#công-nghệ-sử-dụng)
- [Ref](#ref)
- [Các tính năng nổi bật](#các-tính-năng-nổi-bật)
- [Admin Panel](#admin-panel)
- [Note](#note)

## Công nghệ sử dụng

- **Frontend**: HTML, CSS, JS, JQuery, Ajax, Bootstrap 4
- **Backend**: PHP 8.2 - Laravel 11, MySQL, Nginx, AWS-S3
- **Deploy**: Docker, VPS (*hostinger*), domain (*vinahost*)

## Ref

- ***Cam đoan project là duy nhất với các chức năng, logic xử lý, không sao chép, không clone***
- Frontend của project dựa trên [Material Able – Free Bootstrap 4 HTML 5 Admin Dashboard Template](https://themewagon.com/themes/free-bootstrap-4-html-5-admin-dashboard-template-material-able/), sau đó chỉnh sửa khá nhiều để ra được giao diện cho toàn bộ trang web như hiện tại.
- Các hình ảnh sản phẩm, dữ liệu mô tả sản phẩm là thật và được tham khảo từ trang [gymstore.vn](https://gymstore.vn/)
- Cấu trúc trang web, giao diện được thiết kế dựa theo cảm quan cá nhân và tham khảo từ [Shopee](https://shopee.vn/), [gymstore.vn](https://gymstore.vn/)

## Các tính năng nổi bật

- Bảo mật:
  - Xác thực 2FA cho admin bằng Google Authenticator
  - CAPTCHA bảo vệ người dùng, ngăn chặn tấn công brute-force
  - Tích hợp AI/ML để phát hiện mã độc trong ảnh JPEG được tải lên - [đồ án môn học](https://github.com/Hjn4Pwn/ML-Detect-Malware-JPEG.git)
  - Xác thực email cho đăng ký, thay đổi, và reset mật khẩu

- Sử dụng Elasticsearch để tìm kiếm nhanh và chính xác
- Hệ thống đánh giá sản phẩm với xếp hạng 1-5 sao và bình luận
- Tính phí vận chuyển qua API GHTK dựa trên khối lượng hàng hóa và khoảng cách địa lý
- Thanh toán online với API VNPay
- Triển khai website trên VPS bằng Docker
- Tích hợp đăng nhập qua Facebook và Google
- Lưu trữ tệp trên AWS-S3

## Admin Panel

- Admin có thể bật tắt tính năng 2fa
- Quản lý Dashboard: visualize doanh số của các tháng trong năm, khách hàng thân thiết, sản phẩm bán chạy
- Quản lý: danh mục, người dùng, sliders, hương vị, đơn hàng, các đánh giá của users
- [Các hình ảnh Admin Panel](https://drive.google.com/drive/folders/1A58QFB4vIrKMa7pmw2W6pwhsOghBfkWv?usp=sharing)

## Note

### Thanh toán online

- Test tính năng thanh toán online với VNPay: [Chi tiết](https://viblo.asia/p/tich-hop-cong-thanh-toan-vnpay-voi-laravel-Az45bGD6KxY)
- Các tài khoản cho môi trường dev xem tại [đây](https://sandbox.vnpayment.vn/apis/vnpay-demo/)
- Ví dụ 1 tài khoản thanh toán thành công:
  - Ngân hàng: **NCB**
  - Số thẻ: **9704198526191432198**
  - Tên chủ thẻ:**NGUYEN VAN A**
  - Ngày phát hành:**07/15**
  - Mật khẩu OTP:**123456**

### Đánh giá sản phẩm

- Điều kiện tiên quyết để có thể đánh giá sản phẩm:
  - Admin duyệt đơn hàng (ship)
  - Người dùng xác nhận đã nhận hàng
- Số lần comment, review chính là số lượng sản phẩm tương ứng trong các đơn hàng đã xác nhận
