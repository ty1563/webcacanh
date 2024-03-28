<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDanhMucRequest;
use App\Models\ChuyenMuc;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DanhMucController extends Controller
{
    public function index()
    {
        $check = ChuyenMuc::count();
        if ($check === 0) {
            toastr("Bạn Cần Thêm Chuyên Mục Trước", 'error', "Lỗi");
            return redirect()->route('chuyenMuc');
        }
        return view("admin.page.DanhMuc.danh-muc");
    }
    public function create(CreateDanhMucRequest $request)
    {
        try {
            $request['slug_danh_muc'] = Str::slug($request->ten_danh_muc);
            DanhMuc::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Thêm Mới Thành Công',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Thêm mới Thất Bại',
            ]);
        }
    }
    public function data(Request $request)
    {
        try {
            $keySearch = $request->keySearch;
            if ($keySearch) {
                $data = DanhMuc::join("chuyen_mucs", "danh_mucs.id_chuyen_muc", "chuyen_mucs.id")
                    ->select("chuyen_mucs.ten_chuyen_muc", 'danh_mucs.*')
                    ->whereAny(['danh_mucs.ten_danh_muc','chuyen_mucs.ten_chuyen_muc'], "LIKE", "%" . $keySearch . "%")
                    ->orderBy("danh_mucs.xep_hang","asc")
                    ->get();
                return response()->json([
                    'status' => true,
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'data' => DanhMuc::join("chuyen_mucs", "danh_mucs.id_chuyen_muc", "chuyen_mucs.id")
                                    ->select("chuyen_mucs.ten_chuyen_muc", 'danh_mucs.*')
                                    ->orderBy("danh_mucs.xep_hang","asc")
                                    ->get(),
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Lấy Dữ Liệu Thất Bại',
            ]);
        }
    }
    public function destroy($id)
    {
        try {
            $check = DanhMuc::find($id);
            if ($check) {
                $check->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Xóa Thành Công',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Xóa Thất Bại',
            ]);
        }
    }
    public function update(Request $request)
    {
        try {
            $check = DanhMuc::find($request->id);
            if ($check) {
                $request['slug_danh_muc'] = Str::slug($request->ten_danh_muc);
                $check->update($request->all());
                $check->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Cập Nhật Thành Công',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Không Tìm Thấy Danh Mục',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Cập Nhật Thất Bại',
            ]);
        }
    }
}
