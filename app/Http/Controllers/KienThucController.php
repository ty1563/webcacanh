<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKienThucRequest;
use App\Models\KienThuc;
use App\Models\SanPham;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KienThucController extends Controller
{
    public function index()
    {
        return view("admin.page.KienThuc.kien-thuc");
    }
    public function create(CreateKienThucRequest $request)
    {
        try {
            $check = in_array("-1", $request->list_san_pham);
            if ($check) {
                $request['list_san_pham'] = null;
            }
            $slug = Str::slug($request->title);
            $img = explode(",", $request->filepath)[0];
            KienThuc::create([
                'title'         => $request->title,
                'slug'          => $slug,
                'hinh_anh'      => $img,
                'date'          => Carbon::now('Asia/Ho_Chi_Minh'),
                'tinh_trang'    => $request->tinh_trang,
                'list_san_pham' => json_encode($request->list_san_pham),
                'list_tag'      => json_encode($request->list_tag),
                'mo_ta'         => $request->mo_ta,
                'noi_dung'      => $request->noi_dung
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Thêm Thành Công',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Thất Bại',
            ]);
        }
    }
    public function data()
    {
        $data = KienThuc::get();
        $data = $data->map(function ($item) {
            $item->list_san_pham = SanPham::whereIn("id",json_decode($item->list_san_pham))->pluck("ten_san_pham");
            return $item;
        });
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
        try {
            $data = KienThuc::get();
            $data = $data->map(function ($item) {
                $item->list_san_pham = SanPham::whereIn("id",explode(",",$item->list_san_pham))->pluck("name");
                return $item;
            });
            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
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
            $check = KienThuc::find($id);
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
