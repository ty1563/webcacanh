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
        Schema::create('kien_thucs', function (Blueprint $table) {
            $table->id();
            $table->string("title")->require;
            $table->string("slug")->require;
            $table->string("mo_ta",2000)->require;
            $table->text("noi_dung")->require;
            $table->string('date')->nullable();
            $table->boolean("tinh_trang")->default(1);
            $table->json("list_san_pham")->nullable();
            $table->json("list_tag")->nullable();
            $table->string("hinh_anh")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kien_thucs');
    }
};
