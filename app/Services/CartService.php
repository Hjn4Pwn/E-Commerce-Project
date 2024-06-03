<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductFlavor;
use App\Services\Interfaces\CartServiceInterface;

/**
 * Class CartService
 * @package App\Services
 */
class CartService implements CartServiceInterface
{
    public function getUserCart($userId)
    {
        return Cart::firstOrCreate(['user_id' => $userId]);
    }

    public function addItemToCart($cartId, $productId, $quantity, $flavorId)
    {
        // Truy xuất quantity từ bảng pivot product_flavors
        $productFlavor = ProductFlavor::where('product_id', $productId)
            ->where('flavor_id', $flavorId)
            ->first();

        if (!$productFlavor) {
            throw new \Exception("Product or Flavor not found.");
        }

        $availableQuantity = $productFlavor->quantity;

        $cartItem = CartItem::where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->where('flavor_id', $flavorId)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;
            $cartItem->quantity = min($newQuantity, $availableQuantity);
            $cartItem->save();
        } else {
            $newQuantity = min($quantity, $availableQuantity);
            $cartItem = CartItem::create([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'quantity' => $newQuantity,
                'flavor_id' => $flavorId,
            ]);
        }

        return $cartItem;
    }


    public function getCartItems($userId)
    {
        $cart = Cart::where('user_id', $userId)
            ->with(['items.product.mainImage', 'items.flavor'])
            ->first();

        if (!$cart) {
            return collect([]);
        }

        $cartItems = $cart->items->map(function ($item) {
            $productFlavor = ProductFlavor::where('product_id', $item->product_id)
                ->where('flavor_id', $item->flavor_id)
                ->first();

            return [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'flavor_id' => $item->flavor_id,
                'quantity' => $item->quantity,
                'available_quantity' => $productFlavor ? $productFlavor->quantity : 0,
                'product' => $item->product,
                'flavor' => $item->flavor,
            ];
        });

        return $cartItems;
    }


    public function removeItem($userId, $productId, $flavorId)
    {
        $cart = Cart::where('user_id', $userId)->first();

        if ($cart) {
            $cartItem = $cart->items()
                ->where('product_id', $productId)
                ->where('flavor_id', $flavorId)
                ->first();

            if ($cartItem) {
                $cartItem->delete();
                return ['status' => 'success', 'message' => 'Sản phẩm đã được xóa thành công'];
            }
        }

        return ['status' => 'error', 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng'];
    }
}
