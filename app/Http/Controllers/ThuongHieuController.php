<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateThuongHieuRequest;
use App\Models\DanhMuc;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ThuongHieuController extends Controller
{
    public function index()
    {
        $check = DanhMuc::count();
        if ($check === 0) {
            toastr("Bạn Cần Thêm Chuyên Mục Trước", 'error', "Lỗi");
            return redirect()->route('danhMuc');
        }
        return view("admin.page.ThuongHieu.thuong-hieu");
    }
    public function create(CreateThuongHieuRequest $request)
    {
        try {
            $request['slug_thuong_hieu'] = Str::slug($request->ten_thuong_hieu);
            ThuongHieu::create($request->all());
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
                $data = ThuongHieu::join("danh_mucs", "thuong_hieus.id_danh_muc", "danh_mucs.id")
                    ->select("danh_mucs.ten_danh_muc", 'thuong_hieus.*')
                    ->whereAny(['danh_mucs.ten_danh_muc', 'thuong_hieus.ten_thuong_hieu'], "LIKE", "%" . $keySearch . "%")
                    ->get();
                return response()->json([
                    'status' => true,
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'data' => ThuongHieu::join("danh_mucs", "thuong_hieus.id_danh_muc", "danh_mucs.id")
                                    ->select("danh_mucs.ten_danh_muc", 'thuong_hieus.*')
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
    public function update(Request $request)
    {
        try {
            $check = ThuongHieu::find($request->id);
            if ($check) {
                $request['slug_thuong_hieu'] = Str::slug($request->slug_thuong_hieu);
                $check->update($request->all());
                $check->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Cập Nhật Thành Công',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Không Tìm Thấy Thương Hiệu',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Cập Nhật Thất Bại',
            ]);
        }
    }
    public function destroy($id)
    {
        try {
            $check = ThuongHieu::find($id);
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
}
