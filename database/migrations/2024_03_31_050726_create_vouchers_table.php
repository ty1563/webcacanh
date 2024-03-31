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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string("code")->unique();
            $table->string("mo_ta",2000)->nullable();
            $table->integer("giam_gia")->require;
            $table->dateTime("het_han")->require;
            $table->integer("max_uses")->default(1000);
            $table->integer("used")->default(0);
            $table->boolean("status")->require;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
