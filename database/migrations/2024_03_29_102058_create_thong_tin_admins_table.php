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
        Schema::create('thong_tin_admins', function (Blueprint $table) {
            $table->id();
            $table->string("avatar")->nullable();
            $table->string("mobile")->nullable();
            $table->string("facebook")->nullable();
            $table->string("zalo")->nullable();
            $table->string("messenger")->nullable();
            $table->string("instagram")->nullable();
            $table->string("twitter")->nullable();
            $table->string("dia_chi_1")->nullable();
            $table->string("dia_chi_2")->nullable();
            $table->string("github")->nullable();
            $table->unsignedBigInteger('id_admin')->require;
            $table->foreign('id_admin')->references('id')->on('admins')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('thong_tin_admins');
    }
};
