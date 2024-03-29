<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChuyenMucController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\KienThucController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\ThuongHieuController;
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => '/admin'], function () {
    Route::get('/login', [AdminController::class, 'login']);
    Route::post('/login-admin-check', [AdminController::class, 'checkLogin']);
    Route::get('/logout', [AdminController::class, 'loggout']);
});
Route::group(['prefix' => '/admin','middleware' => ['adminCheck']], function () {
    Route::group(['prefix' => '/chuyen-muc','middleware' => ['chuyenMucCheck']], function () {
        Route::get("/", [ChuyenMucController::class, 'index'])->name("chuyenMuc");
        Route::post("/create", [ChuyenMucController::class, 'create']);
        Route::post("/data", [ChuyenMucController::class, 'data']);
        Route::put("/update", [ChuyenMucController::class, 'update']);
        Route::delete("/delete/{id}", [ChuyenMucController::class, 'destroy']);
    });
    Route::group(['prefix' => '/danh-muc','middleware' => ['danhMucCheck']], function () {
        Route::get("/", [DanhMucController::class, 'index'])->name("danhMuc");
        Route::post("/create", [DanhMucController::class, 'create']);
        Route::post("/data", [DanhMucController::class, 'data']);
        Route::put("/update", [DanhMucController::class, 'update']);
        Route::delete("/delete/{id}", [DanhMucController::class, 'destroy']);
    });
    Route::group(['prefix' => '/thuong-hieu','middleware' => ['thuongHieuCheck']], function () {
        Route::get("/", [ThuongHieuController::class, 'index']);
        Route::post("/create", [ThuongHieuController::class, 'create']);
        Route::post("/data", [ThuongHieuController::class, 'data']);
        Route::put("/update", [ThuongHieuController::class, 'update']);
        Route::delete("/delete/{id}", [ThuongHieuController::class, 'destroy']);
    });
    Route::group(['prefix' => '/san-pham','middleware' => ['sanPhamCheck']], function () {
        Route::get("/", [SanPhamController::class, 'index']);
        Route::post("/create", [SanPhamController::class, 'create']);
        Route::post("/data", [SanPhamController::class, 'data']);
        Route::put("/update", [SanPhamController::class, 'update']);
        Route::delete("/delete/{id}", [SanPhamController::class, 'destroy']);
    });
    Route::group(['prefix' => '/kien-thuc','middleware' => ['kienThucCheck']], function () {
        Route::get("/", [KienThucController::class, 'index']);
        Route::post("/create", [KienThucController::class, 'create']);
        Route::post("/data", [KienThucController::class, 'data']);
        Route::delete("/delete/{id}", [KienThucController::class, 'destroy']);
    });
    // Admin
    Route::group(['prefix' => '/admin'], function () {
        Route::get("/", [AdminController::class, 'index']);
        Route::get("/info",[AdminController::class,'info']);
        Route::put("/updateInfo",[AdminController::class,'update']);
        Route::post("/add", [AdminController::class, 'add'])->middleware("isMaster");
        Route::post("/data", [AdminController::class, 'data']);
        Route::post("/delete/{id}", [AdminController::class, 'delete'])->middleware("isMaster");
        Route::post("/quyen", [AdminController::class, 'quyen'])->middleware("isMaster");
    });
});

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
