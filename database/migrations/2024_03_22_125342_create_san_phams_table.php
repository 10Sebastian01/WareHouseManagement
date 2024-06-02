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
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id();
            $table->string('tenthuoc');
            $table->foreignId('danhmucsanpham_id')->constrained('danhmucsanpham');
            $table->foreignId('nhomthuoc_id')->nullable()->constrained('nhomthuoc');
            $table->foreignId('phanloaiduoc_id')->nullable()->constrained('phanloaiduoc');
            $table->string('hoatchat')->nullable();
            $table->foreignId('donvitinh_id')->constrained('donvitinh');
            $table->foreignId('cachdung_id')->constrained('cachdung');

            $table->enum('kedon', ['co', 'khong'])->default('khong');

            $table->foreignId('hangsanxuat_id')->constrained('hangsanxuat');
            $table->foreignId('nhacungcap_id')->constrained('nhacungcap');
            $table->string('quocgia')->nullable();
            $table->enum('nguonnhap', ['bh', 'tp'])->default('bh');
            $table->double('gianhap');
            $table->double('giaxuat');

            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};
