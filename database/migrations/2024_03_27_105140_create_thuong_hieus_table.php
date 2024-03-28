<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('thuong_hieus', function (Blueprint $table) {
            $table->id();
            $table->string("ten_thuong_hieu")->require;
            $table->string("slug_thuong_hieu")->require;
            $table->string("thong_tin_thuong_hieu",500)->require;
            $table->unsignedBigInteger('id_danh_muc')->require;
            $table->foreign('id_danh_muc')->references('id')->on('danh_mucs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thuong_hieus');
    }
};
