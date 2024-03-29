<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminRequest;
use App\Models\Admin;
use App\Models\ThongTinAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view("admin.page.Login.login");
    }
    public function info()
    {
        $info = Auth::guard('admin')->user();
        $data = ThongTinAdmin::where("id_admin",$info->id)->first();
        return view('admin.page.Admin.profile', compact('info','data'));
    }
    public function checkLogin(Request $request)
    {
        if (
            Auth::guard('admin')->attempt([
                'username' => $request->username,
                'password' => $request->password
            ]) ||
            Auth::guard('admin')->attempt([
                'email' => $request->username,
                'password' => $request->password
            ])
        ) {
            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }
    public function loggout()
    {
        Auth::guard('admin')->logout();
        toastr()->success('Đã Đăng xuất thành công!');
        return redirect('/admin/login');
    }
    public function index()
    {
        return view("admin.page.Admin.index");
    }
    public function add(CreateAdminRequest $request)
    {
        try {
            Admin::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'email'    => $request->email,
                'ho_ten'   => $request->ho_ten ? $request->ho_ten : null,
                'sdt'      => $request->sdt ? $request->sdt : null,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Thêm Thành Công',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Thêm Thất Bại',
            ]);
        }
    }
    public function data()
    {
        try {
            $data = Admin::with('thongTinAdmins')->get();
            $data = $data->map(function ($index){
                $index->quyen = explode(",", $index->quyen);
                return $index;
            });
            return response()->json([
                'status' => true,
                'message' => 'Thành Công',
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Thất Bại',
            ]);
        }
    }
    public function update(Request $request)
    {
        $data = ThongTinAdmin::where("id_admin", $request->id)->first();
        if (!$data) {
            ThongTinAdmin::create([
                'facebook' => $request->facebook,
                'mobile' => $request->mobile,
                'messenger' => $request->messenger,
                'zalo' => $request->zalo,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'github' => $request->github,
                'dia_chi_1' => $request->dia_chi_1,
                'dia_chi_2' => $request->dia_chi_2,
                'id_admin' => $request->id,
            ]);
        } else {
            $data->update([
                'facebook' => $request->facebook,
                'mobile' => $request->mobile,
                'messenger' => $request->messenger,
                'zalo' => $request->zalo,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'github' => $request->github,
                'dia_chi_1' => $request->dia_chi_1,
                'dia_chi_2' => $request->dia_chi_2,
            ]);
            $data->save();
        }
        return response()->json([
            'status' => true,
            'message' => 'Lưu Thông Tin Thành Công',
        ]);
    }
    public function quyen(Request $request)
    {
        try {
            $check = Admin::find($request->id);
            $check->update([
                'quyen' => $request->quyen,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Cập Nhật Quyền Thành Công',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Cập Nhật Thất Bại',
            ]);
        }
    }
    public function delete($id)
    {
        try {
            Admin::find($id)->delete();
            return response()->json([
                'status' => true,
                'message' => 'Xóa Thành Công',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Xóa Thất Bại',
            ]);
        }
    }
}
