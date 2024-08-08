<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Services\Interfaces\ImageServiceInterface;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Class ImageService
 * @package App\Services
 */
class ImageService implements ImageServiceInterface
{
    public function removeBackgroundAndStore(Request $request, $accessFile = "image")
    {
        if ($request->hasFile($accessFile)) {
            $file = $request->file($accessFile);
            $image = Image::make($file);

            if (!in_array($image->mime(), ['image/png'])) {
                $image = $image->encode('png');
            }

            $filename = time() . '_' . uniqid() . '.png';
            $tempPath = sys_get_temp_dir() . '/' . $filename;

            $image->save($tempPath);

            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://api.remove.bg/v1.0/removebg', [
                'multipart' => [
                    [
                        'name'     => 'image_file',
                        'contents' => fopen($tempPath, 'r')
                    ],
                    [
                        'name'     => 'size',
                        'contents' => 'auto'
                    ]
                ],
                'headers' => [
                    'X-Api-Key' => env('REMOVE_BG_API_KEY')
                ]
            ]);

            $s3Path = 'images/products/' . $filename;
            Storage::disk('s3')->put($s3Path, $response->getBody());

            unlink($tempPath);

            return $s3Path;
        }

        throw new Exception('No image uploaded or failed to remove background');
        return true;
    }

    public function deleteImage($ImagePath)
    {
        Storage::disk('s3')->delete($ImagePath);
    }

    public function storeProductImage(Product $product, $path, $sort_order)
    {
        $product->images()->create([
            'path' => $path,
            'sort_order' => $sort_order,
        ]);
    }

    public function getImagesByProduct(Product $product)
    {
        return $product->images()->orderBy('sort_order')->get();
    }

    public function deleteImagesByProduct(Product $product)
    {
        $images = $product->images;
        foreach ($images as $image) {
            $this->deleteImage($image->path);
            $image->delete();
        }
    }

    public function getMainImageForProduct(Product $product)
    {
        return $product->images()->where('sort_order', 1)->first();
    }

    public function deleteImagesByPath($path)
    {
        ProductImage::where('path', $path)->delete();
    }

    public function storeImageWithRole(Request $request, $accessFile = "avatar", $role = "users")
    {
        if ($request->hasFile($accessFile)) {
            $file = $request->file($accessFile);
            $image = Image::make($file);

            if ($image->mime() !== 'image/png') {
                $image = $image->encode('png');
            }

            $filename = time() . '_' . uniqid() . '.png';

            $s3Path = 'images/' . $role . '/' . $filename;
            Storage::disk('s3')->put($s3Path, $image->stream());

            return $s3Path;
        }
        throw new Exception('No image uploaded');
    }

    public function checkMalwareJPEG($imagePath, $imageName)
    {
        $response = Http::attach('file', file_get_contents($imagePath), $imageName)
            ->post(env('Malware_JPEG_Detection_URL'));

        return $response->json('result');
    }
}
