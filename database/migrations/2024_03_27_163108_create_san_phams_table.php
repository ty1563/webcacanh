<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string("ten_san_pham")->require;
            $table->string("slug_san_pham")->require;
            $table->string("hinh_anh",500)->require;
            $table->text("mo_ta")->require;
            $table->integer("gia_ban")->default(0);
            $table->string("xep_hang")->require;
            $table->boolean("size_active")->default(0);
            $table->boolean("tinh_trang")->default(1);
            $table->unsignedBigInteger('id_danh_muc')->require;
            $table->foreign('id_danh_muc')->references('id')->on('danh_mucs')->onDelete('cascade');
            $table->unsignedBigInteger('id_thuong_hieu')->require;
            $table->foreign('id_thuong_hieu')->references('id')->on('thuong_hieus');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
