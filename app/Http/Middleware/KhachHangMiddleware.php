<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KhachHangMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('khach')->check()) {
            return $next($request);
        } else {
            toastr()->error("Bạn Cần Đăng Nhập Trước");
            return redirect()->route('login');
        }
    }
}
