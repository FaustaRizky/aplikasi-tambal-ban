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
    Schema::create('kulaan_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kulaan_id')->constrained()->onDelete('cascade');
        $table->foreignId('barang_id')->constrained()->onDelete('cascade');
        $table->integer('jumlah');
        $table->decimal('harga_satuan', 15, 2); // harga beli per barang
        $table->decimal('subtotal', 15, 2); // jumlah × harga_satuan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kulaan_details');
    }
};
