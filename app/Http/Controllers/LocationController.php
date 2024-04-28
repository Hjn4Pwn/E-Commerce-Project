<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\LocationServiceInterface;

class LocationController extends Controller
{
    protected $locationService;

    public function __construct(
        LocationServiceInterface $locationService
    ) {
        $this->locationService = $locationService;
    }

    public function getDistrictsByProvinceId($provinceId)
    {
        return $this->locationService->getDistrictsByProvinceId($provinceId);
    }

    public function getWardsByDistrictId($districtId)
    {
        return $this->locationService->getWardsByDistrictId($districtId);
    }
}
