<?php

namespace App\Services;

use App\Models\Admin;
use App\Services\Interfaces\AdminServiceInterface;
use App\Services\Interfaces\LocationServiceInterface;
use Illuminate\Support\Facades\Hash;

/**
 * Class AdminService
 * @package App\Services
 */
class AdminService implements AdminServiceInterface
{
    protected $locationService;

    public function __construct(
        LocationServiceInterface $locationService,
    ) {
        $this->locationService = $locationService;
    }

    public function update($admin, $validatedData)
    {
        return $admin->update($validatedData);
    }

    public function getAddress()
    {
        $shop_address = Admin::select('province_id', 'district_id', 'ward_id', 'address_detail')->first();
        // dd($shop_address);
        $address_detail = $shop_address['address_detail'];
        $ward_name = $this->locationService->getNameByWardId($shop_address["ward_id"]);
        $district_name = $this->locationService->getNameByDistrictId($shop_address["district_id"]);
        $province_name = $this->locationService->getNameByProvinceId($shop_address["province_id"]);
        return $address_detail . ', ' . $ward_name . ', ' . $district_name . ', ' . $province_name;
    }

    public function getAdminByEmail(string $email): ?Admin
    {
        return Admin::where('email', $email)->first();
    }

    public function resetPassword($admin, $newPassword)
    {
        $admin->password = Hash::make($newPassword);
        $admin->save();

        return ['status' => 'success'];
    }

    public function changePassword($admin, $currentPassword, $newPassword)
    {
        if (!Hash::check($currentPassword, $admin->password)) {
            return [
                'status' => 'error',
                'field' => 'current_password',
                'message' => 'Mật khẩu cũ không đúng.',
            ];
        }

        $admin->password = Hash::make($newPassword);
        $admin->save();

        return ['status' => 'success'];
    }
}
