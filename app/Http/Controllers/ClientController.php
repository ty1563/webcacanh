<?php

namespace App\Http\Controllers;

use App\Models\ChuyenMuc;
use App\Models\DanhMuc;
use App\Models\KienThuc;
use App\Models\SanPham;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
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
    public function wishlist()
    {
        return view("Client.page.Wishlist.wishlist");
    }
    public function sProduct($slug)
    {
        $data = SanPham::with("sizeCustoms")
            ->where("slug_san_pham", $slug)
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
    }
    public function checkout()
    {
        return view("Client.page.Checkout.checkout");
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
                $check->used += 1;
                $check->id_user = $check->id_user . "," . Auth::guard("khach")->user()->id;
                $check->save();
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
    public function product(){
        $category = ChuyenMuc::with("danhMucs")->get();
        $data = SanPham::with("sizeCustoms")->get()->map(function ($item){
            $item->hinh_anh = explode(",",$item->hinh_anh);
            return $item;
        });
        foreach ($data as $value) {
            if ($value->size_active == 1) {
                $value['min_gia_ban'] =  min($value->sizeCustoms->pluck('gia_ban')->toArray());
                $value['max_gia_ban'] =  max($value->sizeCustoms->pluck('gia_ban')->toArray());
            }
        }
        return view("Client.page.Product.shop-list",compact('data','category'));
    }
}
