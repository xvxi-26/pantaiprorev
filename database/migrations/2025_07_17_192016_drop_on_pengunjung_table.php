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
        Schema::table('pengunjung', function (Blueprint $table) {
            if (Schema::hasColumn('pengunjung', 'wisata_id')) {
                $table->dropColumn('wisata_id');
            }

            if (Schema::hasColumn('pengunjung', 'waktu_kunjungan')) {
                $table->dropColumn('waktu_kunjungan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengunjung', function (Blueprint $table) {
            $table->unsignedBigInteger('wisata_id')->nullable();
            $table->foreign('wisata_id')->references('id')->on('wisata')->onDelete('cascade');

            $table->dateTime('waktu_kunjungan')->nullable();
        });
    }
};
