<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saldos', function (Blueprint $table) {
            $table->id();
            $table->decimal('saldo', 15, 2)->default(0); // simpan saldo dengan format uang
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saldos');
    }
};