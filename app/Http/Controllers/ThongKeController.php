<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class ThongKeController extends Controller
{
    public function index()
    {
        return view("admin.page.ThongKe.index");
    }
    public function  dataChart(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        if ($from && $to) {
            $don_hang_trong_thang = DonHang::whereBetween('created_at', [Carbon::parse($from)->subDay(), Carbon::parse($to)->addDay()])
                ->orderBy('created_at')
                ->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('Y-m-d');
                });
        } else {
            $don_hang_trong_thang = DonHang::whereMonth('created_at', Carbon::now()->month)
                ->orderBy('created_at')
                ->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('Y-m-d');
                });
        }

        $labels = [];
        $revenues = [];
        $orders = [];

        foreach ($don_hang_trong_thang as $ngay => $don_hang_theo_ngay) {
            $total_revenue = $don_hang_theo_ngay->sum('total');
            $total_orders = $don_hang_theo_ngay->count();

            $labels[] = Carbon::parse($ngay)->format('d/m');
            $revenues[] = $total_revenue;
            $orders[] = $total_orders;
        }

        return response()->json([
            'status' => true,
            'message' => 'Thành Công',
            'labels' => $labels,
            'revenues' => $revenues,
            'orders' => $orders,
        ]);
    }
    public function dataDonHang()
    {
        $data = DonHang::with("khachHangs")->latest()->take(5)->get();
        $data->transform(function ($item, $key) {
            $item->thoi_gian_dat_hang = \Carbon\Carbon::parse($item->created_at)->translatedFormat('j/n/Y g:i A');
            return $item;
        });
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
}
