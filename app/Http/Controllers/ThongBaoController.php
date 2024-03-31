<?php

namespace App\Http\Controllers;

use App\Jobs\JobSendMailThongBao;
use App\Models\KhachHang;
use App\Models\ThongBao;
use Illuminate\Http\Request;

class ThongBaoController extends Controller
{
    public function index()
    {
        return view("admin.page.ThongBao.index");
    }
    public function data(Request $request)
    {
        $keySearch = $request->keySearch;
        if ($keySearch) {
            $data = KhachHang::whereAny(["email", "username"], "LIKE", '%' . $keySearch . '%')
                ->select("email", "username", "status")
                ->get();
            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        } else {
            $data = KhachHang::select("email", "username", "status")->get();
            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        }
    }
    public function clearData(){
        ThongBao::truncate();
        return response()->json([
            'status' => true,
        ]);
    }
    public function sendMail(Request $request)
    {
        session()->flash('email_notifications', "Đã gửi mail cho email");
        $type = $request->type;
        if ($type == 1) {
            $listEmail = $request->listEmail;
            if ($listEmail) {
                JobSendMailThongBao::dispatch($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Đang Gửi Tất Cả Danh Sách Email',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Thất Bại',
                ]);
            }
        } else {
            $request['listEmail'] = KhachHang::select("email", "status")->get();
            JobSendMailThongBao::dispatch($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Đang Gửi Tất Cả Danh Sách Khách Hàng',
            ]);
        }
    }
}
