<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class KhachHangController extends Controller
{

    public function index()
    {
        return view("admin.page.KhachHang.khach-hang");
    }
    public function data(Request $request)
    {   $keySearch = $request->keySearch;
        if($keySearch){
            $data = KhachHang::whereAny(['username','email'],"LIKE",'%'.$keySearch.'%')
                            ->select('id',"username","email",'coin','status')
                            ->orderBy("created_at", 'desc')->paginate(10);
        }else{
            $data = KhachHang::select('id',"username","email",'coin','status')
                            ->orderBy("created_at", 'desc')->paginate(10);
        }
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
    public function change($id)
    {
        $check = KhachHang::find($id);
        if ($check) {
            $check->status = !$check->status;
            $check->save();
            return response()->json([
                'status' => true,
                'message' => 'Chuyển Trạng Thái Thành Công',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Chuyển Trạng Thái Thất Bại',
            ]);
        }
    }
    public function search(Request $request)
    {
        $search = KhachHang::where("username", "like","%".$request->searchKey."%")->orderBy('created_at','desc')->get();
        if(count($search)>0){
            return response()->json([
                'status' => true,
                'data' => $search,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message'=>'Không Tìm Thấy',
            ]);
        }
    }
    public function update_coin(Request $request){
        $check = KhachHang::find($request->id);
        $check->coin = $request->coin == null ? 0 : $request->coin;
        $check->save();
        $new = number_format($request->coin ,0, ',', '.') . '₫';
        return response()->json([
            'status' => true,
            'message'=>'Thành Công Số Dư User '. $check->username . ' Là '. $new,
        ]);
    }
    public function delete($id)
    {
        try {
            KhachHang::find($id)->delete();
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
    public function changePassword(Request $request){
        try {
            $pass1 = $request->newPassword1;
            $pass2 = $request->newPassword2;
            if($pass1 && $pass2 && $pass1 === $pass2){
                $id = $request->id;
                if($id){
                    KhachHang::find($id)->update([
                        'password' => bcrypt($pass1),
                    ]);
                    return response()->json([
                        'status' => true,
                        'message'=>'Cập Nhật Mật Khẩu Thành Công',
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'message'=>'Có Lỗi',
                    ]);
                }
            }else{
                return response()->json([
                    'status' => false,
                    'message'=>'Không Trùng',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message'=>'Có Lỗi',
            ]);
        }
    }
}
