<?php

namespace App\Services;

use App\Services\Interfaces\ImageServiceInterface;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Class ImageService
 * @package App\Services
 */
class ImageService implements ImageServiceInterface
{
    public function removeBackgroundAndStore(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
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

            $path = 'storage/images/products/' . $filename;
            Storage::disk('public')->put('images/products/' . $filename, $response->getBody());

            unlink($tempPath);

            return $path;
        }

        throw new Exception('No image uploaded or failed to remove background');
        return true;
    }

    public function deleteImage($ImagePath)
    {
        $ImagePath = str_replace('storage/', '', $ImagePath);
        Storage::disk('public')->delete($ImagePath);
    }
}
