<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lakus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->integer('jumlah'); // jumlah barang yang laku
            $table->date('tanggal_laku');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lakus');
    }
};
