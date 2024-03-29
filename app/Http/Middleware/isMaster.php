<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isMaster
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard("admin")->user()->is_master) {
            return $next($request);
        }
        toastr()->error("Quyền Này Chỉ Dành Cho Ông Chủ");
        return redirect("/admin/admin");
    }
}
