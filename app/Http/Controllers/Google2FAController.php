<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validate2faRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class Google2FAController extends Controller
{
    public function showEnable2faForm(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $google2fa = app('pragmarx.google2fa');
        $google2fa_secret = $user->google2fa_secret ?: $google2fa->generateSecretKey();
        $google2fa_url = $google2fa->getQRCodeInline('GymStore', $user->email, $google2fa_secret);

        if (!$user->google2fa_secret) {
            $request->session()->flash('google2fa_secret', $google2fa_secret);
        }

        return view('admin.pages.adminInfo.2fa', [
            'google2fa_url' => $google2fa_url,
            'secret' => $google2fa_secret,
            'user' => $user,
            'enabled' => (bool) $user->google2fa_secret,
        ]);
    }

    public function showValidate2faForm(Request $request)
    {
        if (!$request->session()->has('2fa:user:id')) {
            return redirect()->route('admin.login')->withErrors('Phiên đăng nhập không hợp lệ.');
        }

        return view('admin.pages.2fa-validate');
    }

    public function verifyEnable2fa(Validate2faRequest $request)
    {
        $user = auth()->guard('admin')->user();
        $google2fa_secret = $request->session()->get('google2fa_secret');
        $google2fa = app('pragmarx.google2fa');

        if ($google2fa->verifyKey($google2fa_secret, $request->input('one_time_password'))) {
            $user->google2fa_secret = $google2fa_secret;
            $user->save();
            return redirect('/admin')->with('success', "2FA đã được bật thành công.");
        }

        return back()->withErrors(['one_time_password' => 'Mã OTP không chính xác.']);
    }

    public function disable2fa(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $user->google2fa_secret = null;
        $user->save();

        return redirect('/admin')->with('success', "2FA đã được tắt thành công.");
    }

    public function validate2fa(Request $request)
    {
        $adminId = $request->session()->get('2fa:user:id');
        $admin = Admin::find($adminId);
        $google2fa = app('pragmarx.google2fa');

        if ($google2fa->verifyKey($admin->google2fa_secret, $request->input('one_time_password'))) {
            Auth::guard('admin')->login($admin);
            $request->session()->forget(['2fa:user:id']);
            return redirect()->intended('admin/')->with('success', 'Đăng nhập thành công.');
        }

        return back()->withErrors(['one_time_password' => 'Mã OTP không chính xác.']);
    }

    // public function test()
    // {
    //     echo 'Current server timezone: ' . date_default_timezone_get();
    // }

}
