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
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->string("ten")->require;
            $table->string("email")->nullable();
            $table->string("phone")->require;
            $table->string("dia_chi")->require;
            $table->string("dia_chi_cu_the")->require;
            $table->integer("tien_hang")->require();
            $table->string("ma_giam_gia")->nullable();
            $table->integer("total")->require();
            $table->string("hash")->nullable();
            $table->boolean("thanh_toan")->default(0);
            $table->integer("giao_hang")->default(0);
            $table->unsignedBigInteger('id_khach_hang')->require;
            $table->foreign('id_khach_hang')->references('id')->on('khach_hangs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
