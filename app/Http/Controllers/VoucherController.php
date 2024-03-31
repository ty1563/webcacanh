<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        return view("admin.page.Voucher.voucher");
    }
    public function create(CreateVoucherRequest $request)
    {
        try {
            Voucher::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Tạo Thành Công',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Tạo Thất Bại',
            ]);
        }
    }
    public function data(Request $request)
    {
        try {
            $keySearch = $request->keySearch;
            if ($keySearch) {
                $data = Voucher::whereAny(['code', 'mo_ta'], "LIKE", "%" . $keySearch . "%")->get();
                return response()->json([
                    'status' => true,
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'data' => Voucher::get()->map(function ($items) {
                        $items->het_han = Carbon::parse($items->het_han)->format('d/m/Y');
                        return $items;
                    }),
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
            $check = Voucher::find($id);
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
    public function update(UpdateVoucherRequest $request)
    {
        $check = Voucher::find($request->id);
        if ($check) {
            $request['het_han'] = Carbon::createFromFormat('d/m/Y', $request->het_han)->format('Y-m-d');
            $check->update($request->all());
            $check->save();
            return response()->json([
                'status' => true,
                'message' => 'Cập Nhật Thành Công',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Không Tìm Thấy ',
            ]);
        }
    }
}
