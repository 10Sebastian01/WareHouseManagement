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
        Schema::create('losx', function (Blueprint $table) {
            $table->id();
            $table->string('solo');
            $table->foreignId('sanpham_id')->constrained('sanpham');
            $table->integer('soluong');
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
        Schema::dropIfExists('losx');
    }
};
