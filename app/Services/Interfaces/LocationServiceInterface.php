<?php

namespace App\Services\Interfaces;

/**
 * Interface LocationServiceInterface
 * @package App\Services\Interfaces
 */
interface LocationServiceInterface
{
    public function getAllProvinces();
    public function getDistrictsByProvinceId($provinceId);
    public function getWardsByDistrictId($districtId);
    public function getNameByProvinceId($provinceId);
    public function getNameByDistrictId($districtId);
    public function getNameByWardId($wardId);
}
