<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    public function index(){
        return view("admin.page.DonHang.don-hang");
    }
    public function data(Request $request){
        $keySearch = $request->keySearch;
        if($keySearch){

        }else{
            $data = DonHang::with("khachHangs:id,username,email")->get();
            return response()->json([
                'status' => true,
                'message'=>'Thành Công',
                'data'=>$data,
            ]);
        }
    }
    public function changeThanhToan($hash){
        $donHang = DonHang::where("hash",$hash)->first();
        if($donHang){
            $donHang->thanh_toan = !$donHang->thanh_toan;
            $donHang->save();
            return response()->json([
                'status' => true,
                'message'=>'Thay Đổi Trạng Thái Thành Công',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message'=>'Không Tìm Thấy Đơn Hàng',
            ]);
        }
    }
    public function changeGiaoHang($hash,$code){
        $donHang = DonHang::where("hash",$hash)->first();
        if($donHang){
            if($code == 0){
                $donHang->giao_hang=1;
            }elseif($code==1){
                $donHang->giao_hang=2;
            }else{
                $donHang->giao_hang=0;
            }
            $donHang->save();
            return response()->json([
                'status' => true,
                'message'=>'Thay Đổi Trạng Thái Thành Công',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message'=>'Không Tìm Thấy Đơn Hàng',
            ]);
        }

    }
    public function delete($id)
    {
        try {
            DonHang::find($id)->delete();
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
