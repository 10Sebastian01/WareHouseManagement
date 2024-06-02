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
        Schema::create('donhang', function (Blueprint $table) {
            $table->id();
            $table->string('madon');
            $table->enum('loaidonhang', ['nhaphang', 'xuathang']);
            $table->foreignId('nguoidung_id')->constrained('nguoidung');
            $table->foreignId('nhacungcap_id')->nullable()->constrained('nhacungcap');
            $table->foreignId('khachhang_id')->nullable()->constrained('khachhang');
            $table->foreignId('trangthai_id')->constrained('trangthai');

            $table->string('ghichu')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donhang');
    }
};
