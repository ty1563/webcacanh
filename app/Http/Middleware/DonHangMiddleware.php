<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DonHangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard("admin")->user()->is_master) {
            return $next($request);
        } else {
            $check = Auth::guard("admin")->user()->quyen;
            $check_arr = explode(',', $check);
            foreach ($check_arr as $value) {
                if ($value == "don_hangs") {
                    return $next($request);
                }
            }
        }
        toastr()->error("Bạn Không Có Quyền Đơn Hàng");
        return redirect("/admin/admin");
    }
}
