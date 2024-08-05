<?php

namespace App\Services;

use App\Models\Flavor;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductFlavor;
use App\Models\User;
use App\Services\Interfaces\LocationServiceInterface;
use App\Services\Interfaces\OrderServiceInterface;

use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

/**
 * Class OrderService
 * @package App\Services
 */
class OrderService implements OrderServiceInterface
{
    protected $locationService;

    public function __construct(
        LocationServiceInterface $locationService,
    ) {
        $this->locationService = $locationService;
    }

    public function getAllOrders($search = null)
    {
        // dd($search);
        if ($search) {
            $users = User::search($search)->where('type', 'user')->get();
            $userIds = $users->pluck('id');

            $orders = Order::whereIn('user_id', $userIds)
                ->with(['user'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $orders = Order::with('user')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return $orders;
    }


    public function storeTemporary($data)
    {
        // dd($data);
        Session::put('cart', $data);
    }

    public function getTemporaryData()
    {
        return Session::get('cart', []);
    }

    public function confirmOrder($payment_method, $shop_address)
    {
        $orderData = $this->getTemporaryData();
        // dd((int) $orderData['total_price']);
        $address = session('address') ?? session('original_address');
        $phone = session('phone') ?? session('original_phone');

        // dd($phone);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'note' => $orderData['note'],
                'total_price' => (int) $orderData['total_price'],
                'shipping_fee' => session('shipping_fee'),
                'address' => $address,
                'phone' => $phone,
                'payment_method' => $payment_method,
                'status' => 'pending',
            ]);

            foreach ($orderData['items'] as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'flavor_id' => $item['flavor_id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            foreach ($orderData['items'] as $item) {
                $productFlavor =  ProductFlavor::where('product_id', $item['product_id'])
                    ->where('flavor_id', $item['flavor_id'])
                    ->first();
                $productFlavor->quantity -= (int) $item['quantity'];
                $productFlavor->save();
            }

            Session::forget('cart');
            DB::commit();

            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function getDetailsCartForOrderReview($cartData)
    {
        $detailedCartData = [];

        foreach ($cartData['items'] as $item) {
            $product = Product::find($item['product_id']);
            $flavor = Flavor::find($item['flavor_id']);

            $detailedItem = [
                'product_name' => $product->name,
                'main_image' => $product->main_image->path,
                'flavor_name' => $flavor->name,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ];

            $detailedCartData[] = $detailedItem;
        }
        return $detailedCartData;
    }

    public function getOrders($userId)
    {
        $orders = Order::where('user_id', $userId)
            ->with(['items.product.main_image', 'items.flavor'])
            ->orderBy('created_at', 'desc')
            ->get();

        if ($orders->isEmpty()) {
            return collect([]);
        }

        $result = $orders->map(function ($order) {
            return [
                'order_id' => $order->id,
                'total_price' => $order->total_price,
                'shipping_fee' => $order->shipping_fee,
                'phone' => $order->phone,
                'address' => $order->address,
                'payment_method' => $order->payment_method,
                'note' => $order->note,
                'status' => $order->status,
                'items' => $order->items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'flavor_id' => $item->flavor_id,
                        'quantity' => $item->quantity,
                        'product' => $item->product,
                        'flavor' => $item->flavor,
                    ];
                }),
            ];
        });
        // dd($result);
        return $result;
    }

    public function cancelOrder($orderId)
    {
        $order = Order::find($orderId);
        if ($order) {
            foreach ($order->items as $item) {
                // $productFlavor = ProductFlavor::where('product_id', $item->product_id)
                //     ->where('flavor_id', $item->flavor_id)
                //     ->first();

                $productFlavor = ProductFlavor::where([
                    ['product_id', '=', $item->product_id],
                    ['flavor_id', '=', $item->flavor_id]
                ])->first();

                if ($productFlavor) {
                    $productFlavor->quantity += (int) $item->quantity;
                    $productFlavor->save();
                }
            }

            $order->status = 'cancelled';
            $order->save();
        } else {
            throw new \Exception('Order not found');
        }
    }

    public function calculateShippingFee(): string
    {
        $orderData = $this->getTemporaryData();
        // dd($orderData);
        $total_price = $orderData['total_price'];
        $total_weight = 0;

        foreach ($orderData['items'] as $item) {
            $product = Product::find($item['product_id']);
            $total_weight += $item['quantity'] * $product->weight;
        }

        // Helper function to parse the address
        function parseAddress(string $address): array
        {
            $address_parts = array_map('trim', explode(",", $address));
            $province_name = array_pop($address_parts);
            $district_name = array_pop($address_parts);
            $ward_name = array_pop($address_parts);
            $address_detail = implode(", ", $address_parts);

            return [
                'province_name' => $province_name,
                'district_name' => $district_name,
                'ward_name' => $ward_name,
                'address_detail' => $address_detail
            ];
        }

        $to_address = session('address') ?? session('original_address');
        $from_address = session('shop_address');

        $to_address_parsed = parseAddress($to_address);
        $from_address_parsed = parseAddress($from_address);

        $data = [
            "pick_province" => $from_address_parsed['province_name'],
            "pick_district" => $from_address_parsed['district_name'],
            "province" => $to_address_parsed['province_name'],
            "district" => $to_address_parsed['district_name'],
            "address" => $to_address_parsed['address_detail'] . ", " . $to_address_parsed['ward_name'],
            "weight" => $total_weight,
            "value" => $total_price,
            "transport" => "road",
            "deliver_option" => "none",
            "tags" => [1]
        ];

        try {
            $response = Http::withHeaders([
                'Token' => env('GHTK_TOKEN'),
            ])->post(env('GHTK_URL'), $data);

            $responseData = $response->json();

            if (isset($responseData['success']) && $responseData['success']) {
                return (string)$responseData['fee']['fee'];
            } else {
                return 'Failed to calculate shipping fee: ' . ($responseData['message'] ?? 'Unknown error');
            }
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getOrderById($encryptedId)
    {
        $orderId = Crypt::decrypt($encryptedId);

        $order = Order::where('id', $orderId)
            ->with(['items.product.main_image', 'items.flavor', 'user'])
            ->first();

        return $order;
    }

    public function updateOrderStatus(Order $order, $status)
    {
        $order->status = $status;
        $order->save();
    }

    public function updateQuantitySold(Order $order)
    {
        if ($order) {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);

                if ($product) {
                    $product->quantity_sold += (int) $item->quantity;
                    $product->save();
                }
            }
        } else {
            throw new \Exception('Order not found');
        }
    }
}
