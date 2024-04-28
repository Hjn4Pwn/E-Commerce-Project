<?php

namespace App\Services;

use App\Services\Interfaces\LocationServiceInterface;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;

/**
 * Class LocationService
 * @package App\Services
 */
class LocationService implements LocationServiceInterface
{
    public function getAllProvinces()
    {
        // có thể dùng repository để tương tác thẳng tới dữ liệu
        // return Province::all();

        // Trả về tất cả các tỉnh
        return Province::with('districts')->get(); // Tải sẵn các quận/huyện liên kết
    }

    public function getDistrictsByProvinceId($provinceId)
    {
        // $districts = District::where('province_code', $provinceId)->get();

        // Tải sẵn các xã/phường liên kết với các quận/huyện
        $districts = Province::findOrFail($provinceId)->districts;
        $output = '<option value="">Select a Ward</option>';
        foreach ($districts as $district) {
            $output .= '<option value="' . $district->code . '">' . $district->name . '</option>';
        }
        return $output;
    }
    public function getWardsByDistrictId($districtId)
    {
        // $wards = Ward::where('district_code', $districtId)->get();

        // Tải sẵn các xã/phường liên kết với các quận/huyện
        $wards = District::findOrFail($districtId)->wards;
        $output = '<option value="">Select a Ward</option>';
        foreach ($wards as $ward) {
            $output .= '<option value="' . $ward->code . '">' . $ward->name . '</option>';
        }
        return $output;
    }
}
