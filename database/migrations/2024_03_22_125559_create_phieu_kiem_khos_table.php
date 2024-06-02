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
        Schema::create('phieukiemkho', function (Blueprint $table) {
            $table->id();
            $table->string('maphieukiem');
            $table->foreignId('nguoidung_id')->constrained('nguoidung');
            $table->dateTime('ngaykiem');
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
        Schema::dropIfExists('phieukiemkho');
    }
};
