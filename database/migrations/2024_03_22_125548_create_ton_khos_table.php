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
        Schema::create('tonkho', function (Blueprint $table) {
            $table->id();
            $table->foreignId('losx_id')->constrained('losx');
            $table->integer('soluong');
            $table->foreignId('sanpham_id')->constrained('sanpham');
            $table->foreignId('donhang_id')->constrained('donhang');
            $table->dateTime('ngayhethan');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tonkho');
    }
};
