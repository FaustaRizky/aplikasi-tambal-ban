<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('kulaan_details', function (Blueprint $table) {
            $table->dropColumn('subtotal');
        });
    }

    public function down(): void {
        Schema::table('kulaan_details', function (Blueprint $table) {
            $table->decimal('subtotal', 15, 2)->nullable();
        });
    }
};
