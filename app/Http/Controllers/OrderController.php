<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Interfaces\OrderServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\CartServiceInterface;
use App\Services\Interfaces\LocationServiceInterface;
use App\Services\Interfaces\AdminServiceInterface;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class OrderController extends Controller
{

    protected $orderService;
    protected $categoryService;
    protected $cartService;
    protected $locationService;
    protected $adminService;

    public function __construct(
        OrderServiceInterface $orderService,
        CategoryServiceInterface $categoryService,
        CartServiceInterface $cartService,
        LocationServiceInterface $locationService,
        AdminServiceInterface $adminService,
    ) {
        $this->orderService = $orderService;
        $this->categoryService = $categoryService;
        $this->cartService = $cartService;
        $this->locationService = $locationService;
        $this->adminService = $adminService;
    }

    public function storeTemporary(Request $request)
    {
        $data = $request->only(['items', 'note', 'total_price']);
        $this->orderService->storeTemporary($data);

        // Gắn flag để chỉ có thể gọi đến route review khi mà đã gọi storeTemporary
        session(['order_in_progress' => true]);

        return redirect()->route('order.review');
    }

    public function review()
    {

        // Check flag
        if (!session()->has('order_in_progress')) {
            return redirect()->route('cart.index')->with('warning', 'Vui lòng đặt hàng trước khi xác nhận đơn hàng.');
        }

        $user = Auth::user();
        $province = $user->province->name;
        $district = $user->district->name;
        $ward = $user->ward->name;
        $address_detail = $user->address_detail;
        $phone = $user->phone;

        $shop_address = $this->adminService->getAddress();

        session()->put('original_address', $address_detail . ', ' . $ward . ', ' . $district . ', ' . $province);
        session()->put('original_phone', $phone);
        session()->put('shop_address', $shop_address);

        $this->updateSessionShippingFee();
        // session(['original_phone' => $phone]);

        $provinces = $this->locationService->getAllProvinces();

        // $user = User::find(Auth::user()->id)->load(['province', 'district', 'ward']);
        $user = Auth::user()->load(['province', 'district', 'ward']);

        $cartData = $this->orderService->getTemporaryData();
        $categories = $this->categoryService->getAll();

        $OrderReview = $this->orderService->getDetailsCartForOrderReview($cartData);
        return view('shop.pages.reviewOrder', [
            'categories' => $categories,
            'OrderReview' => $OrderReview,
            'user' => $user,
            'provinces' => $provinces,
            'note' => $cartData['note']
        ]);
    }

    public function updateSessionShippingFee()
    {
        $shipping_fee = $this->orderService->calculateShippingFee();
        session()->put('shipping_fee', $shipping_fee);
    }

    public function confirmOrder(Request $request)
    {
        try {
            $shop_address = $this->adminService->getAddress();
            $order = $this->orderService->confirmOrder($request->payment_method, $shop_address);

            // xóa flag
            session()->forget('order_in_progress');

            $encryptedOrderId = Crypt::encrypt($order->id);
            // $encryptedOrderId = encrypt($order->id);
            if ($request->payment_method == 'online_payment') {
                return redirect()->route('vnpay.payment', ['order' => $encryptedOrderId]);
            } else {
                $this->cartService->removeCartByUser(Auth::user());
                session()->forget('phone');
                session()->forget('address');
                session()->forget('shipping_fee');
                return redirect()->route('order.show')->with('success', 'Đặt hàng thành công.');
            }
        } catch (Exception $e) {
            return redirect()->route('order.review')->with('error', 'Đặt hàng thất bại, vui lòng thử lại.');
        }
    }

    public function show()
    {
        $user = auth()->user();
        $orders = $this->orderService->getOrders($user->id);

        $categories = $this->categoryService->getAll();
        return view('shop.pages.orderDetails', [
            'categories' => $categories,
            'orders' => $orders,
        ]);
    }

    public function updateAddress(Request $request)
    {
        $province_name = $this->locationService->getNameByProvinceId($request->province);
        $district_name = $this->locationService->getNameByDistrictId($request->district);
        $ward_name = $this->locationService->getNameByWardId($request->ward);
        $address_detail = $request->address_detail;

        $request->session()->put('address', $address_detail . ', ' . $ward_name . ', ' . $district_name . ', ' . $province_name);

        $this->updateSessionShippingFee();

        return redirect()->back();
    }

    public function updatePhone(Request $request)
    {
        $request->session()->put('phone', $request->phone);
        return redirect()->back();
    }

    public function cancel($encryptedId)
    {
        try {
            // $orderId = Crypt::decrypt($encryptedId);
            $orderId = decrypt($encryptedId);
            $this->orderService->cancelOrder($orderId);

            return redirect()->back()->with('success', 'Hủy đơn hàng thành công.');
        } catch (\Exception $e) {
            Log::error('Order cancellation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hủy đơn hàng thất bại.');
        }
    }

    public function admin_index()
    {
        $orders = $this->orderService->getAll();
        return view('admin.pages.order.orders', [
            'orders' => $orders,
            'page' => 'Orders',
        ]);
    }

    public function admin_viewOrder($id)
    {
        $order = $this->orderService->getOrderById($id);
        // dd($order);
        return view('admin.pages.order.viewOrder', [
            'parentPage' => ['Orders', 'admin.orders'],
            'childPage' => 'Details',
            'order' => $order,
        ]);
    }

    public function ship($encryptedOrder)
    {
        $order = Order::findOrFail(Crypt::decrypt($encryptedOrder));
        $this->orderService->updateOrderStatus($order, 'shipped');
        return redirect()->back()->with('success', 'Đơn hàng đã được cập nhật trạng thái: Đang vận chuyển');
    }

    public function confirmReceipt($encryptedOrder)
    {
        $order = Order::findOrFail(Crypt::decrypt($encryptedOrder));
        $this->orderService->updateOrderStatus($order, 'delivered');
        return redirect()->back()->with('success', 'Đơn hàng đã được cập nhật trạng thái: Nhận hàng thành công');
    }
}
