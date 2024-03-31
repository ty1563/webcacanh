<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VoucherMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard("admin")->user()->is_master) {
            return $next($request);
        } else {
            $check = Auth::guard("admin")->user()->quyen;
            $check_arr = explode(',', $check);
            foreach ($check_arr as $value) {
                if ($value == "vouchers") {
                    return $next($request);
                }
            }
        }
        toastr()->error("Bạn Không Có Quyền Voucher");
        return redirect("/admin/admin");
    }
}
