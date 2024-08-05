<?php

namespace App\Services\Interfaces;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Interface ImageServiceInterface
 * @package App\Services\Interfaces
 */
interface ImageServiceInterface
{
    public function deleteImage($oldImagePath);
    public function removeBackgroundAndStore(Request $request);
    public function storeProductImage(Product $product, $path, $sort_order);
    public function getImagesByProduct(Product $product);
    public function deleteImagesByProduct(Product $product);
    public function deleteImagesByPath($path);
    public function getMainImageForProduct(Product $product);
    public function storeImageWithRole(Request $request);
    public function checkMalwareJPEG($imagePath, $imageName);
}
