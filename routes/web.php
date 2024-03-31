<?php

use App\Http\Controllers\AccountConTroller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChuyenMucController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\KienThucController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\ThongBaoController;
use App\Http\Controllers\ThuongHieuController;
use App\Http\Controllers\VoucherController;
use App\Models\ThongBao;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin'], function () {
    Route::get('/login', [AdminController::class, 'login']);
    Route::post('/login-admin-check', [AdminController::class, 'checkLogin']);
    Route::get('/logout', [AdminController::class, 'loggout']);
});
Route::group(['prefix' => '/admin', 'middleware' => ['adminCheck']], function () {
    // Home
    Route::get("/", [AdminController::class, 'home']);
    // Chuyên Mục
    Route::group(['prefix' => '/chuyen-muc', 'middleware' => ['chuyenMucCheck']], function () {
        Route::get("/", [ChuyenMucController::class, 'index'])->name("chuyenMuc");
        Route::post("/create", [ChuyenMucController::class, 'create']);
        Route::post("/data", [ChuyenMucController::class, 'data']);
        Route::put("/update", [ChuyenMucController::class, 'update']);
        Route::delete("/delete/{id}", [ChuyenMucController::class, 'destroy']);
    });
    // Danh Mục
    Route::group(['prefix' => '/danh-muc', 'middleware' => ['danhMucCheck']], function () {
        Route::get("/", [DanhMucController::class, 'index'])->name("danhMuc");
        Route::post("/create", [DanhMucController::class, 'create']);
        Route::post("/data", [DanhMucController::class, 'data']);
        Route::put("/update", [DanhMucController::class, 'update']);
        Route::delete("/delete/{id}", [DanhMucController::class, 'destroy']);
    });
    // Thương Hiệu
    Route::group(['prefix' => '/thuong-hieu', 'middleware' => ['thuongHieuCheck']], function () {
        Route::get("/", [ThuongHieuController::class, 'index']);
        Route::post("/create", [ThuongHieuController::class, 'create']);
        Route::post("/data", [ThuongHieuController::class, 'data']);
        Route::put("/update", [ThuongHieuController::class, 'update']);
        Route::delete("/delete/{id}", [ThuongHieuController::class, 'destroy']);
    });
    // Sản Phẩm
    Route::group(['prefix' => '/san-pham', 'middleware' => ['sanPhamCheck']], function () {
        Route::get("/", [SanPhamController::class, 'index']);
        Route::post("/create", [SanPhamController::class, 'create']);
        Route::post("/data", [SanPhamController::class, 'data']);
        Route::put("/update", [SanPhamController::class, 'update']);
        Route::delete("/delete/{id}", [SanPhamController::class, 'destroy']);
    });
    // Kien Thuc
    Route::group(['prefix' => '/kien-thuc', 'middleware' => ['kienThucCheck']], function () {
        Route::get("/", [KienThucController::class, 'index']);
        Route::post("/create", [KienThucController::class, 'create']);
        Route::post("/data", [KienThucController::class, 'data']);
        Route::delete("/delete/{id}", [KienThucController::class, 'destroy']);
    });
    // Admin
    Route::group(['prefix' => '/admin'], function () {
        Route::get("/", [AdminController::class, 'index']);
        Route::get("/info", [AdminController::class, 'info']);
        Route::put("/updateInfo", [AdminController::class, 'update']);
        Route::post("/add", [AdminController::class, 'add'])->middleware("isMaster");
        Route::post("/data", [AdminController::class, 'data']);
        Route::post("/delete/{id}", [AdminController::class, 'delete'])->middleware("isMaster");
        Route::post("/quyen", [AdminController::class, 'quyen'])->middleware("isMaster");
    });
    // Khach Hang
    Route::group(['prefix' => '/khach-hang', 'middleware' => ['khachHangCheck']], function () {
        Route::get("/", [KhachHangController::class, 'index']);
        Route::post("/data", [KhachHangController::class, 'data']);
        Route::post("/change/{id}", [KhachHangController::class, 'change']);
        Route::post("/update", [KhachHangController::class, 'update_coin']);
        Route::put("changePassword", [KhachHangController::class, 'changePassword']);
        Route::delete("/delete/{id}", [KhachHangController::class, 'delete']);
    });
    // Voucher
    Route::group(['prefix' => '/voucher' ,'middleware' => ['voucherCheck']], function () {
        Route::get("/", [VoucherController::class, 'index']);
        Route::post("/create", [VoucherController::class, 'create']);
        Route::post("/data", [VoucherController::class, 'data']);
        Route::put("/update", [VoucherController::class, 'update']);
        Route::delete("/delete/{id}", [VoucherController::class, 'destroy']);
    });
    // Thông Báo
    Route::group(['prefix' => '/thong-bao', 'middleware' => ['isMaster']], function () {
        Route::get("/", [ThongBaoController::class, 'index']);
        Route::post("/send-mail", [ThongBaoController::class, 'sendMail']);
        Route::post("/data", [ThongBaoController::class, 'data']);
        Route::post("/clearData",[ThongBaoController::class,'clearData']);
        Route::get("/status",function(){
            return response()->json([
                'status' => true,
                'data'=>ThongBao::select("email")->orderBy("created_at","asc")->get(),
            ]);
        });
    });
});


// Client
Route::get('/', [ClientController::class, 'index'])->name("trang_chu");

// Auth
Route::get('/login', [AccountConTroller::class, 'login'])->name("login");
Route::get('/logout', [AccountController::class, 'logout']);
Route::get("/recover", [AccountController::class, 'recover']);
Route::post('/login-khach-check', [AccountController::class, 'checkLogin']);
Route::post('/sign-khach-check', [AccountController::class, 'checkSign']);
Route::post('/sendMailRecover', [AccountController::class, 'sendMailChange']);
Route::post('/checkMailRecover', [AccountController::class, 'confirmChangeMail']);
Route::post('/changePassword', [AccountController::class, 'changePassword']);
Route::post('/sendMailConfirmEmail', [AccountController::class, 'sendMail']);
Route::post('/sendMailChangeEmail', [AccountController::class, 'sendMailChange']);
Route::post('/confirmChangeMail', [AccountController::class, 'confirmChangeMail']);
Route::post('/changeUsername', [AccountController::class, 'changeUsername']);
Route::post('/changeEmail', [AccountController::class, 'changeEmail']);
Route::post('/recoverPassowrd', [AccountController::class, 'recoverPassowrd']);
Route::get('/xac-minh-email/{hash_active}', [AccountController::class, 'confirmEMail']);


Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
