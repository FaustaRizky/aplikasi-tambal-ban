<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('laku_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laku_id')->constrained('lakus')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barangs');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laku_details');
    }
};
