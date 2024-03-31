<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSanPhamRequest;
use App\Models\DanhMuc;
use App\Models\SanPham;
use App\Models\SizeCustom;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SanPhamController extends Controller
{
    public function index()
    {
        $check = DanhMuc::count();
        if ($check === 0) {
            toastr("Bạn Cần Thêm Danh Mục Trước", 'error', "Lỗi");
            return redirect()->route('danhMuc');
        }
        return view("admin.page.SanPham.san-pham");
    }
    public function create(CreateSanPhamRequest $request)
    {
        $size_active = $request->size_active;
        if ($size_active) {
            $sanPham = SanPham::create([
                'ten_san_pham' => $request->ten_san_pham,
                'slug_san_pham' => Str::slug($request->ten_san_pham),
                'hinh_anh' => $request->hinh_anh,
                'gioi_thieu' => $request->gioi_thieu,
                'mo_ta' => $request->mo_ta,
                'size_active' => $request->size_active,
                'id_danh_muc' => $request->id_danh_muc,
                'id_thuong_hieu' => $request->id_thuong_hieu,
                'tinh_trang' => $request->tinh_trang,
                'xep_hang' => $request->xep_hang,
            ]);
            $formatData = array_map(function ($data) {
                return [
                    'size' => $data['kichCo'],
                    'gia_ban' => $data['giaBan'],
                ];
            }, $request->bienTheSize);
            $sanPham->sizeCustoms()->createMany($formatData);
            return response()->json([
                'status' => true,
                'message' => 'Thêm Mới Sản Phẩm & Custom Size Thành Công',
            ]);
        } else {
            SanPham::create([
                'ten_san_pham' => $request->ten_san_pham,
                'slug_san_pham' => Str::slug($request->ten_san_pham),
                'hinh_anh' => $request->hinh_anh,
                'gioi_thieu' => $request->gioi_thieu,
                'mo_ta' => $request->mo_ta,
                'size_active' => $request->size_active,
                'gia_ban' => $request->gia_ban,
                'id_danh_muc' => $request->id_danh_muc,
                'id_thuong_hieu' => $request->id_thuong_hieu,
                'tinh_trang' => $request->tinh_trang,
                'xep_hang' => $request->xep_hang,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Tạo Mới Sản Phẩm Thành Công',
            ]);
        }
    }
    public function data()
    {
        $sanPhams = SanPham::with('sizeCustoms')->get();
        return response()->json([
            'status' => true,
            'data' => $sanPhams,
            'message' => 'Thành Công',
        ]);
    }
    public function update(Request $request)
    {

        $size_active = $request->size_active;
        $sanPham = SanPham::find($request->id);
        if ($sanPham) {
            if ($size_active) {
                $sanPham->update([
                    'ten_san_pham'      => $request->ten_san_pham,
                    'slug_san_pham'     => Str::slug($request->slug_san_pham),
                    'hinh_anh'          => $request->hinh_anh,
                    'mo_ta'             => $request->mo_ta,
                    'gioi_thieu'        => $request->gioi_thieu,
                    'xep_hang'          => $request->xep_hang,
                    'size_active'       => $size_active,
                    'tinh_trang'        => $request->tinh_trang,
                    'id_danh_muc'       => $request->id_danh_muc,
                    'id_thuong_hieu'    => $request->id_thuong_hieu,
                ]);
                SizeCustom::where("id_san_pham", $request->id)->delete();
                $id_san_pham = $sanPham->id;
                $sizeCustomsData = array_map(function ($data) use ($id_san_pham) {
                    return [
                        'size' => $data['size'],
                        'gia_ban' => $data['gia_ban'],
                        'id_san_pham' => $id_san_pham,
                    ];
                }, $request->size_customs);
                $sizeCustomsData = array_filter($sizeCustomsData, function ($item) {
                    return !empty($item['size']) && !empty($item['gia_ban']) && !empty($item['id_san_pham']); // fillter data trống
                });
                $sizeCustomsData = array_values($sizeCustomsData); // xắp xếp lại index
                $sanPham->sizeCustoms()->createMany($sizeCustomsData);
                return response()->json([
                    'status' => true,
                    'message' => 'Cập Nhật Thành Công',
                ]);
            } else {
                $sanPham->update([
                    'ten_san_pham'      => $request->ten_san_pham,
                    'slug_san_pham'     => Str::slug($request->slug_san_pham),
                    'hinh_anh'          => $request->hinh_anh,
                    'gioi_thieu'        => $request->gioi_thieu,
                    'mo_ta'             => $request->mo_ta,
                    'xep_hang'          => $request->xep_hang,
                    'gia_ban'           => $request->gia_ban,
                    'size_active'       => 0,
                    'tinh_trang'        => $request->tinh_trang,
                    'id_danh_muc'       => $request->id_danh_muc,
                    'id_thuong_hieu'    => $request->id_thuong_hieu,
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Cập Nhật Thành Công',
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Không Tìm Thấy Thương Hiệu',
            ]);
        }
    }
    public function destroy($id)
    {
        try {
            $check = SanPham::find($id);
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
