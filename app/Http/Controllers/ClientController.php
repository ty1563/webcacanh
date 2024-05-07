<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaoDonHangRequest;
use App\Models\ChuyenMuc;
use App\Models\DanhMuc;
use App\Models\DonHang;
use App\Models\KienThuc;
use App\Models\SanPham;
use App\Models\SizeCustom;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function index()
    {
        $slide = SanPham::with('sizeCustoms')->Active()->orderBy('xep_hang', 'asc')->take(3)->get();
        $listSp = SanPham::with('sizeCustoms')->Active()->orderBy('xep_hang', 'asc')
            ->take(20)
            ->get()
            ->map(function ($items) {
                $items->hinh_anh = explode(",", $items->hinh_anh);
                return $items;
            });
        $danhMuc = DanhMuc::with([
            'sanPhams' => function ($query) {
                $query->Active()->with(['sizeCustoms']);
            }
        ])->get()->map(function ($danhMuc) {
            if ($danhMuc->sanPhams) {
                $danhMuc->sanPhams->each(function ($sanPham) {
                    if ($sanPham->hinh_anh) {
                        $sanPham->hinh_anh = explode(",", $sanPham->hinh_anh);
                    } else {
                        $sanPham->hinh_anh = [];
                    }
                });
            }
            return $danhMuc;
        });


        $kienThuc = KienThuc::orderBy('created_at', 'desc')
            ->take(2)
            ->get();
        return view("Client.share.index", compact('slide', 'listSp', 'kienThuc', 'danhMuc'));
    }
    public function cart(){
        return view("Client.page.Cart.index");
    }
    public function wishlist()
    {
        return view("Client.page.Wishlist.wishlist");
    }
    public function sProduct($slug)
    {
        try {
            $data = SanPham::with("sizeCustoms")
            ->where("slug_san_pham", $slug)
            ->orWhere("id",$slug)
            ->Active()
            ->first();
        if ($data->size_active) {
            $data['min_gia_ban'] =  min($data->sizeCustoms->pluck('gia_ban')->toArray());
            $data['max_gia_ban'] =  max($data->sizeCustoms->pluck('gia_ban')->toArray());
        }
        $data->hinh_anh = explode(",", $data->hinh_anh);
        $spLienQuan = SanPham::with("sizeCustoms")
            ->where("id_danh_muc", $data->id_danh_muc)
            ->where("id", "!=", $data->id)
            ->Active()
            ->take(5)
            ->get()->map(function ($items) {
                $items->hinh_anh = explode(",", $items->hinh_anh);
                return $items;
            });
        foreach ($spLienQuan as $key => $value) {
            if ($value->size_active == 1) {
                $value['min_gia_ban'] =  min($value->sizeCustoms->pluck('gia_ban')->toArray());
                $value['max_gia_ban'] =  max($value->sizeCustoms->pluck('gia_ban')->toArray());
            }
        }

        return view("Client.page.Product.product", compact("data", 'spLienQuan'));
        } catch (\Throwable $th) {
            toastr()->error("Không Tìm Thấy Sản Phẩm");
            return redirect()->route("trang_chu");
        }
    }
    public function checkout(Request $request)
    {
        $complete = 0;
        $phuong_thuc = null;
        $date = null;
        $hash = null;
        $thanhToan = 0;
        $clear = 0;
        if($request['resultCode'] == 0){
            $donHang = DonHang::where("hash",$request['orderId'])->first();
            if($donHang){
                $complete = 1;
                $hash = $request['orderId'];
                $date = Carbon::now()->setTimezone("Asia/Ho_Chi_Minh");
                $phuong_thuc = $request['orderInfo'];
                $thanhToan = 0;
                $clear = 1;
                $donHang->thanh_toan = 1;
                $donHang->save();
            }

        }
        return view("Client.page.Checkout.checkout",compact('complete','hash','date','phuong_thuc','thanhToan','clear'));
    }
    public function Blog(){
        $monthNames = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];
        $data = KienThuc::get();
        foreach ($data as $item) {
            $item['nam'] = Carbon::parse($item->date)->format('Y');
            $item['thang'] = $monthNames[Carbon::parse($item->date)->format('n')];
            $item['ngay'] = Carbon::parse($item->date)->format('j');
        }
        return view("Client.page.KienThuc.blog",compact('data'));
    }
    public function sBlog($slug)
    {
        $monthNames = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];
        $data = KienThuc::where("slug", $slug)->active()->first();
        $data['thang'] = $monthNames[Carbon::parse($data->date)->format('n')];
        $data['ngay'] = Carbon::parse($data->date)->format('j');
        $spLienQuan = SanPham::with("sizeCustoms")
            ->whereIn("id",json_decode($data->list_san_pham))
            ->Active()
            ->take(5)
            ->get()->map(function ($items) {
                $items->hinh_anh = explode(",", $items->hinh_anh);
                return $items;
            });
        foreach ($spLienQuan as $key => $value) {
            if ($value->size_active == 1) {
                $value['min_gia_ban'] =  min($value->sizeCustoms->pluck('gia_ban')->toArray());
                $value['max_gia_ban'] =  max($value->sizeCustoms->pluck('gia_ban')->toArray());
            }
        }
        $kienThucLienQuan = KienThuc::take(5)->get();
        return view("Client.page.KienThuc.signal-blog", compact('data','spLienQuan','kienThucLienQuan'));
    }
    public function voucher($code)
    {
        $check = Voucher::where("code", $code)->first();
        if ($check) {
            if ($check->used >= $check->max_uses)
                return response()->json([
                    'status' => false,
                    'message' => 'Mã Này Đã Đạt Tối Đa Người Dùng',
                ]);
            if ($check->id_user) {
                if (in_array(Auth::guard("khach")->user()->id, explode(",", $check->id_user))) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Bạn Đã Sử Dụng Mã Giảm Giá Này Rồi',
                    ]);
                }
            }
            $day = Carbon::createFromFormat('Y-m-d H:i:s', $check->het_han);
            if (Carbon::now()->greaterThan($day)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Mã Này Đã Hết Hạn Sử Dụng',
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'chietKhau'  => $check->giam_gia,
                    'message' => 'Áp Dụng Mã Thành Công',
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Mã Bạn Nhập Không Tồn Tại',
            ]);
        }
    }
    public function product(Request $request){
        $idDanhMuc = $request->idDanhMuc;
        $category = ChuyenMuc::with("danhMucs")->get();
        if($idDanhMuc){
            $data = SanPham::with("sizeCustoms")->where("id_danh_muc",$idDanhMuc)->get()->map(function ($item){
                $item->hinh_anh = explode(",",$item->hinh_anh);
                return $item;
            });
        }else{
            $data = SanPham::with("sizeCustoms")->get()->map(function ($item){
                $item->hinh_anh = explode(",",$item->hinh_anh);
                return $item;
            });
        }
        foreach ($data as $value) {
            if ($value->size_active == 1) {
                $value['min_gia_ban'] =  min($value->sizeCustoms->pluck('gia_ban')->toArray());
                $value['max_gia_ban'] =  max($value->sizeCustoms->pluck('gia_ban')->toArray());
            }
        }
        if(count($data) < 1){
            toastr()->error("Không Tìm Thấy Sản Phẩm Nào");
            return redirect()->route("product");
        }
        return view("Client.page.Product.shop-list",compact('data','category'));
    }
    public function process($id,TaoDonHangRequest $request){
        $type = $request->type;
        $hash = "THEGIOICACANH".rand(10000,99999)*$id;
        $listCart = $request->listCart;
        $maGiamGia = $request->maGiamGia;
        $tongTien = $this->tinhTongThanhToan($listCart,$id);
        $tienHang = $tongTien;
        if($maGiamGia != null){
            $giamGia = Voucher::where("code",$maGiamGia)->first();
            if(!$giamGia){
                return response()->json([
                    'status' => false,
                    'message'=>'Mã Giảm Giá Không Tồn Tại',
                ]);
            }else{
                $tongTien -= $giamGia->giam_gia;
                $giamGia->used += 1;
                $giamGia->id_user = $giamGia->id_user . "," . $id;
                $giamGia->save();
            }
        }
        DonHang::create([
            'ten'   => $request->diaChi['ten'],
            'email'   => $request->diaChi['email'],
            'phone'   => $request->diaChi['phone'],
            'dia_chi'   => $request->diaChi['xa']." - ". $request->diaChi['huyen']." - ".$request->diaChi['city'],
            'dia_chi_cu_the'   => $request->diaChi['dia_chi_cu_the'],
            'tien_hang'   => $tienHang,
            'ma_giam_gia'   => $maGiamGia,
            'total'   => $tongTien,
            "hash"    => $hash,
            "id_khach_hang"=> $id,
            'giao_hang' => 0,
            'thanh_toan'   => 0,
        ]);
        if($type == 0){
            return response()->json([
                'status' => true,
                'message'=>'Đặt Hàng Thành Công',
                'hash'  => $hash,
                'date'  => Carbon::now()->setTimezone("Asia/Ho_Chi_Minh"),
                'tongTien'=> $tongTien,
                'phuongThuc'=>"Thanh Toán Khi Nhận Hàng",
            ]);
        }else{
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = "$tongTien";
            $orderId = $hash;
            $redirectUrl = "http://127.0.0.1:8000/checkout";
            $ipnUrl = "http://127.0.0.1:8000/checkout";
            $extraData = "";
            $requestId = time() . "";
            $requestType = "payWithATM";
            $extraData = ($extraData ? $extraData : "");
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);
            if ($jsonResult['message'] == "Thành công.") {
                return response()->json([
                    'status' => true,
                    'message' => 'Đặt hàng thành công đang chuyển bạn đến trang thanh toán',
                    'redirect' => $jsonResult['payUrl'],
                    'hash'  => $hash,
                    'date'  => Carbon::now()->setTimezone("Asia/Ho_Chi_Minh"),
                    'tongTien'=> $tongTien,
                    'phuongThuc'=>"Thanh Toán Online",
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => $jsonResult['message'],
                ]);
            }
        }
    }
    public function tinhTongThanhToan($list,$id){
        $tongTien = 0;
        foreach ($list as $value) {
            if($value['auth'] != $id)
                continue;
            if($value['size_active']==1){
                $check = SizeCustom::where("id_san_pham",$value['id'])
                                    ->where("size",$value['size'])
                                    ->first();
                if($check){
                    $tongTien += $check->gia_ban * $value['so_luong'];
                }
            }else{
                $check = SanPham::where("id",$value['id'])->first();
                if($check){
                    $tongTien += $check->gia_ban * $value['so_luong'];
                }
            }
        }
        return $tongTien;
    }

}
