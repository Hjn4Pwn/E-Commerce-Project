<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\Interfaces\LocationServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\AdminServiceInterface;
use App\Services\Interfaces\VerificationServiceInterface;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{
    protected $locationService;
    protected $imageService;
    protected $adminService;
    protected $verificationService;

    public function __construct(
        LocationServiceInterface $locationService,
        ImageServiceInterface $imageService,
        AdminServiceInterface $adminService,
        VerificationServiceInterface $verificationService,
    ) {
        $this->locationService = $locationService;
        $this->imageService = $imageService;
        $this->adminService = $adminService;
        $this->verificationService = $verificationService;
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
            $path = $this->imageService->storeImageWithRole($request, "avatar", "admins");
            $validatedData['avatar'] = $path;
        }
        // dd($validatedData);

        if ($this->adminService->update($admin, $validatedData)) {
            return redirect()->route('admin.edit')->with('success', 'Cập nhật thành công.');
        }

        return back()->withErrors('Cập nhật thất bại.');
    }

    public function showResetPasswordForm()
    {
        return view('admin.pages.reset-password');
    }


    public function resetPassword(ResetPasswordRequest $request)
    {
        if (!$this->verificationService->emailExists($request->email, 'admin')) {
            return back()->withErrors('Email không tồn tại trong hệ thống.')->withInput();
        }

        $validatedData = $request->validated();

        $isValid = $this->verificationService->validateVerificationCode($validatedData['email'], $validatedData['code'], $validatedData['role']);

        if ($isValid) {
            $admin = $this->adminService->getAdminByEmail($request->email);
            $result = $this->adminService->resetPassword($admin, $request->password);
            if ($result['status'] == 'error') {
                return back()->withErrors([$result['field'] => $result['message']]);
            }
        } else {
            return back()->withErrors('Mã xác thực không đúng hoặc đã hết hạn.')->withInput();
        }

        return redirect()->route('admin.login')->with('success', 'Đã đổi mật khẩu thành công. Hãy đăng nhập');
    }

    public function showChangePasswordForm()
    {
        return view('admin.pages.AdminInfo.change-password', [
            'page' => 'Admin Change Password',
        ]);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $validatedData = $request->validated();

        $admin = auth()->guard('admin')->user();

        $isValid = $this->verificationService->validateVerificationCode($admin->email, $validatedData['code'], $validatedData['role']);

        if ($isValid) {
            $result = $this->adminService->changePassword($admin, $request->current_password, $request->new_password);
            if ($result['status'] == 'error') {
                return back()->withErrors([$result['field'] => $result['message']]);
            }
        } else {
            return back()->withErrors('Mã xác thực không đúng hoặc đã hết hạn.');
        }

        return redirect()->back()->with('success', 'Đã đổi mật khẩu thành công.');
    }
}
