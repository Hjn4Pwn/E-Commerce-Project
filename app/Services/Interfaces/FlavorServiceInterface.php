<?php

namespace App\Services\Interfaces;

use App\Models\Flavor;
use App\Models\Product;

/**
 * Interface FlavorServiceInterface
 * @package App\Services\Interfaces
 */
interface FlavorServiceInterface
{
    public function getAll();
    public function store($validatedData);
    public function update(Flavor $flavor, $validatedData);
    public function delete(Flavor $flavor);
    public function storeProductFlavor(Product $product, $flavorId, $quantity);
    public function getFlavorsByProduct(Product $product);
    public function getFlavorsWithCheckedStatus(Product $product);
    public function getFlavorIDByProduct(Product $product);
    public function updateProductFlavors(Product $product, $newFlavors, $quantity);
    public function deleteFlavorByProduct(Product $product);
    public function deleteProductFlavor(Product $product, $flavorId);
}
