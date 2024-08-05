<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\Interfaces\VerificationServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class AuthUserController extends Controller
{
    protected $verificationService;
    protected $userService;

    public function __construct(
        VerificationServiceInterface $verificationService,
        UserServiceInterface $userService,
    ) {
        $this->verificationService = $verificationService;
        $this->userService = $userService;
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->withInput();
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $isValid = $this->verificationService->validateVerificationCode($validatedData['email'], $validatedData['code'], $validatedData['role']);

        if ($isValid) {
            $user = new User([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $user->save();
            return redirect()->route('login')->with('success', 'Đăng ký thành công. Hãy đăng nhập.');
        } else {
            return back()->withErrors('Mã xác thực không đúng hoặc đã hết hạn.')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Đăng xuất thành công.');
    }


    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'role' => 'required|string',
        ]);

        $email = null;

        switch ($request->role) {
            case 'user-reset-password':
                if (!$this->verificationService->emailExists($request->email, 'user')) {
                    return response()->json(['errors' => ['email' => ['Email không tồn tại trong hệ thống.']]], 400);
                }

            case 'user-register':
                $request->validate([
                    'email' => 'required|email',
                ]);
                $email = $request->email;
                break;
            case 'user-change-password':
                $email = auth()->user()->email;
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


    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $authUser = $this->userService->findOrCreateUser($user, 'facebook');

            auth()->login($authUser, true);
            return redirect()->route('shop.index');
        } catch (ValidationException $e) {
            return redirect()->route('login')->withErrors($e->errors());
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $authUser = $this->userService->findOrCreateUser($user, 'google');

            auth()->login($authUser, true);
            return redirect()->route('shop.index');
        } catch (ValidationException $e) {
            return redirect()->route('login')->withErrors($e->errors());
        }
    }
}
