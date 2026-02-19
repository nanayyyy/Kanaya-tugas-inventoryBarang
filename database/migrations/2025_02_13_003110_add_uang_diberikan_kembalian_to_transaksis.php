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
        Schema::table('transaksis', function (Blueprint $table) {
            $table->decimal('uang_diberikan', 15, 2)->after('total_harga')->nullable();
            $table->decimal('kembalian', 15, 2)->after('uang_diberikan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn(['uang_diberikan', 'kembalian']);
        });
    }
};
