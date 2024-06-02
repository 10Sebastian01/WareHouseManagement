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
        Schema::create('phieukiemkhochitiet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phieukiemkho_id')->constrained('phieukiemkho');
            $table->foreignId('sanpham_id')->constrained('sanpham');
            $table->foreignId('losx_id')->constrained('losx');
            $table->foreignId('donvitinh_id')->constrained('donvitinh');
            $table->dateTime('ngayhethan');
            $table->integer('soluongtonkho');
            $table->integer('soluongthucte');
            $table->integer('chenhlech');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieukiemkhochitiet');
    }
};
