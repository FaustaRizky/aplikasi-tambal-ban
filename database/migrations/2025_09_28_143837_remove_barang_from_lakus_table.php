<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('lakus', function (Blueprint $table) {
        // Hapus dulu foreign key
        $table->dropForeign(['barang_id']); // nama kolom, bukan index

        // Baru hapus kolom
        $table->dropColumn(['barang_id', 'jumlah']);
    });
}


public function down()
{
    Schema::table('lakus', function (Blueprint $table) {
        $table->unsignedBigInteger('barang_id');
        $table->integer('jumlah');
    });
}

};
