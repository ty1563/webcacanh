<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChuyenMucRequest;
use App\Models\ChuyenMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChuyenMucController extends Controller
{
    public function index()
    {
        return view("admin.page.ChuyenMuc.chuyen-muc");
    }
    public function create(CreateChuyenMucRequest $request)
    {
        try {
            $request['slug_chuyen_muc'] = Str::slug($request->ten_chuyen_muc);
            ChuyenMuc::create($request->all());
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
                $data = ChuyenMuc::whereAny(['ten_chuyen_muc', 'gioi_thieu'], "LIKE", "%" . $keySearch . "%")->get();
                return response()->json([
                    'status' => true,
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'data' => ChuyenMuc::get(),
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
            $check = ChuyenMuc::find($request->id);
            if ($check) {
                $request['slug_chuyen_muc'] = Str::slug($request->ten_chuyen_muc);
                $check->update($request->all());
                $check->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Cập Nhật Thành Công',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Không Tìm Thấy Chuyên Mục',
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
            $check = ChuyenMuc::find($id);
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
