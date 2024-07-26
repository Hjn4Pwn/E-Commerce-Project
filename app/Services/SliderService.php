<?php

namespace App\Services;

use App\Models\Slider;
use App\Services\Interfaces\SliderServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;


/**
 * Class SliderService
 * @package App\Services
 */
class SliderService implements SliderServiceInterface
{
    protected $imageService;

    public function __construct(
        ImageServiceInterface $imageService,
    ) {
        $this->imageService = $imageService;
    }

    public function getAllSliders()
    {
        return Slider::all();
    }

    public function createSlider($title, $imagePath)
    {
        return Slider::create([
            'title' => $title,
            'image_path' => $imagePath,
        ]);
    }

    public function deleteSlider(Slider $slider)
    {
        $this->imageService->deleteImage($slider->image_path);
        $slider->delete();
    }
}
