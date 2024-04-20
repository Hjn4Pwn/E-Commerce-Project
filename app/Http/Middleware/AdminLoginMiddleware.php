<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu route hiện tại là 'admin.login' và người dùng đã đăng nhập
        if (Auth::guard('admin')->check() && $request->route()->named('admin.login')) {
            return redirect()->route('admin.index')->with('warning', 'Are you serious???');
        }
        return $next($request);
    }
}
