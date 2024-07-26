<?php

namespace App\Services\Interfaces;

use App\Models\Slider;

/**
 * Interface SliderServiceInterface
 * @package App\Services\Interfaces
 */
interface SliderServiceInterface
{
    public function getAllSliders();
    public function createSlider($title, $imagePath);
    public function deleteSlider(Slider $slider);
}
