<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // hanya jalankan kalau kolom ada
        if (Schema::hasColumn('lakus', 'barang_id')) {
            Schema::table('lakus', function (Blueprint $table) {
                // drop foreign key dulu (nama otomatis: lakus_barang_id_foreign)
                $table->dropForeign(['barang_id']);
                // lalu drop kolom barang_id dan jumlah
                $table->dropColumn(['barang_id', 'jumlah']);
            });
        }
    }

    public function down(): void
    {
        Schema::table('lakus', function (Blueprint $table) {
            $table->unsignedBigInteger('barang_id')->nullable();
            $table->integer('jumlah')->default(0);
            // restore foreign key
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
        });
    }
};
