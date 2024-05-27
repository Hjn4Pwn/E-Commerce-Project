<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
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
        $cartItem = CartItem::where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->where('flavor_id', $flavorId)
            ->first();

        $product = $cartItem ? $cartItem->product : Product::find($productId);

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;
            $cartItem->quantity = min($newQuantity, $product->quantity);
            $cartItem->save();
        } else {
            $newQuantity = min($quantity, $product->quantity);
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
        return $cart ? $cart->items : collect([]);
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
