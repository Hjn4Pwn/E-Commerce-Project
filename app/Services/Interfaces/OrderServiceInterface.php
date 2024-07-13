<?php

namespace App\Services\Interfaces;

use App\Models\Order;

/**
 * Interface OrderServiceInterface
 * @package App\Services\Interfaces
 */
interface OrderServiceInterface
{
    public function getAll();
    public function storeTemporary($data);
    public function getTemporaryData();
    public function confirmOrder($payment_method, $shop_address);
    public function getDetailsCartForOrderReview($cartData);
    public function getOrders($userId);
    public function cancelOrder($orderId);
    public function calculateShippingFee();
    public function getOrderById($encryptedId);
    public function updateOrderStatus(Order $order, $status);
}
