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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string("username")->unique();
            $table->string("email")->unique();
            $table->string("password")->require();
            $table->string("ho_ten")->nullable();
            $table->string("sdt")->nullable();
            $table->string("quyen")->nullable();
            $table->string("hash_active")->nullable();
            $table->string("hash_reset")->nullable();
            $table->string("is_master")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
