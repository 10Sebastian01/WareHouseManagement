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
        Schema::create('nhacungcap', function (Blueprint $table) {
            $table->id();
            $table->string('tennhacungcap');
            $table->string('tenviettat')->nullable();
            $table->string('masothue');
            $table->string('sodienthoai')->nullable();
            $table->string('diachi')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhacungcap');
    }
};
