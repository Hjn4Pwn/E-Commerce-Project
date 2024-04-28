<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

/**
 * Interface ImageServiceInterface
 * @package App\Services\Interfaces
 */
interface ImageServiceInterface
{
    public function deleteImage($oldImagePath);
    public function removeBackgroundAndStore(Request $request);
}
