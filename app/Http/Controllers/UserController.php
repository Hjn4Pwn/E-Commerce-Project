<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\LocationServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\VerificationServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    protected $userService;
    protected $categoryService;
    protected $locationService;
    protected $imageService;
    protected $verificationService;

    public function __construct(
        UserServiceInterface $userService,
        CategoryServiceInterface $categoryService,
        LocationServiceInterface $locationService,
        ImageServiceInterface $imageService,
        VerificationServiceInterface $verificationService,
    ) {
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->locationService = $locationService;
        $this->imageService = $imageService;
        $this->verificationService = $verificationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $search = $request->input('search');
        $users = $this->userService->paginateUsers($search);
        return view('admin.pages.user.index', [
            'users' => $users,
            'page' => 'Khách hàng',
            'search' => $search,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $provinces = $this->locationService->getAllProvinces();
        return view('admin.pages.user.edit', [
            'provinces' => $provinces,
            'user' => $user,
            'parentPage' => ['Khách hàng', 'admin.users.index'],
            'childPage' => 'Chỉnh sửa',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();
        if ($this->userService->updateUser($user, $validatedData)) {
            return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công');
        }
        return back()->withErrors('Cập nhật người dùng thất bại.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($this->userService->deleteUser($user)) {
            return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công');
        }
        return back()->withErrors('Xóa người dùng thất bại.');
    }

    public function editProfile()
    {
        $provinces = $this->locationService->getAllProvinces();
        $categories = $this->categoryService->getAllCategories();
        $user = Auth::user()->load(['province', 'district', 'ward']);
        return view('shop.pages.profile', [
            'provinces' => $provinces,
            'user' => $user,
            'categories' => $categories,
        ]);
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $user = Auth::user();
        if ($request->hasFile('avatar') && $user->avatar) {

            $avatar = $request->file('avatar');
            $image = Image::make($avatar);

            if ($image->mime() === 'image/jpeg' || $image->mime() === 'image/jpg') {
                $result = $this->imageService->checkMalwareJPEG($avatar->getPathname(), $avatar->getClientOriginalName());

                if ($result === 'malicious') {
                    return back()->with('error', 'Tệp JPEG có chứa mã độc.');
                }
            }

            $this->imageService->deleteImage($user->avatar);
        }
        $validatedData = $request->validated();

        if ($request->hasFile('avatar')) {
            $path = $this->imageService->storeImageWithRole($request);
            $validatedData['avatar'] = $path;
        }

        if ($this->userService->updateUser($user, $validatedData)) {
            return redirect()->route('user.editProfile')->with('success', 'Cập nhật hồ sơ thành công');
        }

        return back()->withErrors('Cập nhật hồ sơ thất bại.');
    }

    public function showChangePasswordForm()
    {
        if (!auth()->user()->hasProvider()) {
            $categories = $this->categoryService->getAllCategories();
            return view('shop.pages.change-password', [
                'categories' => $categories,
            ]);
        } else {
            return redirect()->route('shop.index')->with('warning', 'Bạn nghiêm túc chứ!!!');
        }
    }

    public function showResetPasswordForm()
    {
        return view('shop.pages.reset-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $validatedData = $request->validated();
        $user = Auth::user();
        $isValid = $this->verificationService->validateVerificationCode($user->email, $validatedData['code'], $validatedData['role']);

        if ($isValid) {
            $result = $this->userService->changePassword($request->user(), $request->current_password, $request->new_password);
            if ($result['status'] == 'error') {
                return back()->withErrors([$result['field'] => $result['message']]);
            }
        } else {
            return back()->withErrors('Mã xác thực không đúng hoặc đã hết hạn.');
        }

        return redirect()->back()->with('success', 'Đã đổi mật khẩu thành công.');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        if (!$this->verificationService->emailExists($request->email, 'user')) {
            return back()->withErrors('Email không tồn tại trong hệ thống.');
        }

        $validatedData = $request->validated();
        $isValid = $this->verificationService->validateVerificationCode($validatedData['email'], $validatedData['code'], $validatedData['role']);

        if ($isValid) {
            $user = $this->userService->getUserByEmail($request->email);
            $result = $this->userService->resetPassword($user, $request->password);
            if ($result['status'] == 'error') {
                return back()->withErrors([$result['field'] => $result['message']]);
            }
        } else {
            return back()->withErrors('Mã xác thực không đúng hoặc đã hết hạn.');
        }

        return redirect()->route('login')->with('success', 'Đã đổi mật khẩu thành công. Hãy đăng nhập');
    }
}
