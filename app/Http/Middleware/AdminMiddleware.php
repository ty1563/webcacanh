<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard("admin")->check()){
            return $next($request);
        }else{
            toastr('Bạn cần đăng nhập trước','error',"Lỗi");
            return redirect("/admin/login");
        }
    }
}
