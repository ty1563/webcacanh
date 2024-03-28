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
        Schema::create('danh_mucs', function (Blueprint $table) {
            $table->id();
            $table->string("ten_danh_muc")->require;
            $table->string("slug_danh_muc")->require;
            $table->text("mo_ta")->nullable();
            $table->integer("xep_hang")->require;
            $table->unsignedBigInteger('id_chuyen_muc')->require;
            $table->foreign('id_chuyen_muc')->references('id')->on('chuyen_mucs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_mucs');
    }
};
