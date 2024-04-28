<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminAuthRequest;


class AdminController extends Controller
{

    public function __construct()
    {
        //
    }

    public function auth(AdminAuthRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.index')->with('success', 'Login successfully');
        }

        return redirect()->route('admin.login')->with('error', 'Email or Password is incorrect');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logout successfully');
    }
}
