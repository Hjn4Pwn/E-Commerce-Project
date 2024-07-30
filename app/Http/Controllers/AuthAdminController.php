<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\VerificationServiceInterface;


class AuthAdminController extends Controller
{
    protected $verificationService;

    public function __construct(
        VerificationServiceInterface $verificationService,
    ) {
        $this->verificationService = $verificationService;
    }

    public function showLoginForm()
    {
        return view('admin.pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('admin/')->with('success', 'Đăng nhập thành công.');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login')->with('success', 'Đăng xuất thành công.');
    }

    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'role' => 'required|string',
        ]);

        $email = null;

        switch ($request->role) {
            case 'admin-reset-password':
                $request->validate([
                    'email' => 'required|email',
                ]);

                if (!$this->verificationService->emailExists($request->email, 'admin')) {
                    return response()->json(['errors' => ['email' => ['Email không tồn tại trong hệ thống.']]], 400);
                }

                $email = $request->email;
                break;
            case 'admin-change-password':
                $email = auth()->guard('admin')->user()->email;
                if (!$email) {
                    return response()->json(['message' => 'Email không được tìm thấy cho tài khoản hiện tại.'], 400);
                }
                break;
            default:
                return response()->json(['message' => 'Role không hợp lệ.'], 400);
        }

        $this->verificationService->sendVerificationCode($email, $request->role);

        return response()->json(['message' => 'Mã xác thực đã được gửi.']);
    }
}
