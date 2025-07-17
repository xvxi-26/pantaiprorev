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
        Schema::table('galeri', function (Blueprint $table) {
            // Tambah foreign key hanya jika belum ada
            if (!Schema::hasColumn('galeri', 'wisata_id')) {
                $table->foreignId('wisata_id')->constrained('wisata')->onDelete('cascade');
            } else {
                // Jika kolom sudah ada tapi belum ada constraint
                $table->foreign('wisata_id')->references('id')->on('wisata')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropForeign(['wisata_id']);
        });
    }
};
