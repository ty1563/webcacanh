<?php

use App\Http\Controllers\ChuyenMucController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\ThuongHieuController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin'], function () {
    Route::group(['prefix' => '/chuyen-muc'], function () {
        Route::get("/", [ChuyenMucController::class, 'index'])->name("chuyenMuc");
        Route::post("/create", [ChuyenMucController::class, 'create']);
        Route::post("/data", [ChuyenMucController::class, 'data']);
        Route::put("/update", [ChuyenMucController::class, 'update']);
        Route::delete("/delete/{id}", [ChuyenMucController::class, 'destroy']);
    });
    Route::group(['prefix' => '/danh-muc'], function () {
        Route::get("/", [DanhMucController::class, 'index'])->name("danhMuc");
        Route::post("/create", [DanhMucController::class, 'create']);
        Route::post("/data", [DanhMucController::class, 'data']);
        Route::put("/update", [DanhMucController::class, 'update']);
        Route::delete("/delete/{id}", [DanhMucController::class, 'destroy']);
    });
    Route::group(['prefix' => '/thuong-hieu'], function () {
        Route::get("/", [ThuongHieuController::class, 'index']);
        Route::post("/create", [ThuongHieuController::class, 'create']);
        Route::post("/data", [ThuongHieuController::class, 'data']);
        Route::put("/update", [ThuongHieuController::class, 'update']);
        Route::delete("/delete/{id}", [ThuongHieuController::class, 'destroy']);
    });
    Route::group(['prefix' => '/san-pham'], function () {
        Route::get("/", [SanPhamController::class, 'index']);
        Route::post("/create", [SanPhamController::class, 'create']);
        Route::post("/data", [SanPhamController::class, 'data']);
        Route::put("/update", [SanPhamController::class, 'update']);
        Route::delete("/delete/{id}", [SanPhamController::class, 'destroy']);
    });
});

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
