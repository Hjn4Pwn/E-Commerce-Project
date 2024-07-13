<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\LocationServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\AdminServiceInterface;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{
    protected $locationService;
    protected $imageService;
    protected $adminService;

    public function __construct(
        LocationServiceInterface $locationService,
        ImageServiceInterface $imageService,
        AdminServiceInterface $adminService,
    ) {
        $this->locationService = $locationService;
        $this->imageService = $imageService;
        $this->adminService = $adminService;
    }

    public function edit()
    {
        $provinces = $this->locationService->getAllProvinces();
        $admin = Auth::guard('admin')->user();
        return view('admin.pages.AdminInfo.edit', [
            'provinces' => $provinces,
            'admin' => $admin,
            'page' => 'Admin Profile',
        ]);
    }

    public function update(UpdateAdminRequest $request)
    {
        $admin = Auth::guard('admin')->user();
        if ($request->hasFile('avatar') && $admin->avatar) {
            $this->imageService->deleteImage($admin->avatar);
        }

        $validatedData = $request->validated();

        if ($request->hasFile('avatar')) {
            $path = $this->imageService->storeAvatar($request, "avatar", "admins");
            $validatedData['avatar'] = $path;
        }
        // dd($validatedData);

        if ($this->adminService->update($admin, $validatedData)) {
            return redirect()->route('admin.edit')->with('success', 'Profile updated successfully');
        }

        return back()->withErrors('Failed to update profile.');
    }
}
