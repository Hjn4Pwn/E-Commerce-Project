<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use App\Services\Interfaces\CartServiceInterface;


class VNPayController extends Controller
{
    protected $cartService;

    public function __construct(
        CartServiceInterface $cartService,
    ) {
        $this->cartService = $cartService;
    }

    public function createPayment($encryptedOrderId)
    {
        $orderId = Crypt::decrypt($encryptedOrderId);

        // Lấy đối tượng Order từ ID
        $order = Order::findOrFail($orderId);

        // Xác minh người dùng hiện tại có quyền truy cập vào đơn hàng
        if ($order->user_id !== Auth::id()) {
            throw new Exception('Bạn không có quyền truy cập vào đơn hàng này.');
        }

        // dd((int) $order->total_amount);

        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = env('VNP_URL');
        $vnp_Returnurl = env('VNP_RETURN_URL');
        $vnp_TmnCode = env('VNP_TMN_CODE');
        $vnp_HashSecret = env('VNP_HASH_SECRET');

        $vnp_TxnRef = (string) $order->id; // Sử dụng order_id làm mã đơn hàng
        $vnp_OrderInfo = "Thanh toán đơn hàng";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = (int) $order->total_price * 100; // Giả sử tổng số tiền đơn hàng được lưu trong trường total_amount của bảng orders
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function returnPayment(Request $request)
    {
        $vnp_HashSecret = env('VNP_HASH_SECRET');

        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . "=" . urlencode($value) . "&";
        }
        $hashData = rtrim($hashData, '&');
        // dd($hashData);

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        $orderId = (int) $inputData['vnp_TxnRef'];
        $order = Order::find($orderId);

        try {
            if ($secureHash == $vnp_SecureHash) {
                if ($order) {
                    if ($order->total_price == $inputData['vnp_Amount'] / 100) {
                        if ($order->status == 'pending') {
                            if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                $this->savePayment($inputData, true);
                                $order->status = 'processing';
                                $order->save();
                                $this->cartService->removeCartByUser(Auth::user());
                                session()->forget('phone');
                                session()->forget('address');
                                return redirect()->route('order.show')->with('success', 'Thanh toán thành công.');
                            } else {
                                return redirect()->route('cart.index')->with('error', 'Thanh toán thất bại.');
                            }
                        } else {
                            return redirect()->route('order.show')->with('info', 'Đơn hàng đã được xác nhận.');
                        }
                    } else {
                        return redirect()->route('cart.index')->with('error', 'Số tiền không hợp lệ.');
                    }
                } else {
                    return redirect()->route('cart.index')->with('error', 'Không tìm thấy đơn hàng.');
                }
            } else {
                return redirect()->route('cart.index')->with('error', 'Chữ ký không hợp lệ.');
            }
        } catch (Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Lỗi không xác định.');
        }
    }

    protected function savePayment($inputData, $status)
    {
        $orderId = (int) $inputData['vnp_TxnRef'];

        Payment::create([
            'order_id' => $orderId,
            'transaction_no' => $inputData['vnp_TransactionNo'],
            'response_code' => $inputData['vnp_ResponseCode'],
            'amount' => $inputData['vnp_Amount'] / 100,
            'bank_code' => $inputData['vnp_BankCode'],
            'pay_date' => $inputData['vnp_PayDate'],
            'status' => $status
        ]);
    }
}
