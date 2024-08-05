<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\SliderServiceInterface;



class SliderController extends Controller
{
    protected $imageService;
    protected $sliderService;

    public function __construct(
        ImageServiceInterface $imageService,
        SliderServiceInterface $sliderService,
    ) {
        $this->imageService = $imageService;
        $this->sliderService = $sliderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = $this->sliderService->getAllSliders();
        return view('admin.pages.slider.index', [
            'page' => 'Sliders',
            'sliders' => $sliders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.slider.create', [
            'parentPage' => ['Sliders', 'admin.sliders.index'],
            'childPage' => 'Create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        $imagePath = $this->imageService->storeImageWithRole($request, "slider_image", "sliders");
        $this->sliderService->createSlider($request->input('title'), $imagePath);

        return redirect()->route('admin.sliders.index')->with('success', 'Tạo slider thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $this->sliderService->deleteSlider($slider);
        return redirect()->route('admin.sliders.index')->with('success', 'Xóa slider thành công.');
    }
}
