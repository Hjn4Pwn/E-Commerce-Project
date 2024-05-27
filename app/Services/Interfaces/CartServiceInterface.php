<?php

namespace App\Services\Interfaces;

/**
 * Interface CartServiceInterface
 * @package App\Services\Interfaces
 */
interface CartServiceInterface
{
    public function getUserCart($userId);
    public function addItemToCart($cartId, $productId, $quantity, $flavorId);
    public function getCartItems($userId);
    public function removeItem($userId, $productId, $flavorId);
}
