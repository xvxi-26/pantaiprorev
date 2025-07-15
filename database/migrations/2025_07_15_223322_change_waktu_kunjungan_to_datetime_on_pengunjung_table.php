<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengunjung', function (Blueprint $table) {
            $table->dateTime('waktu_kunjungan')->change();
        });
    }

    public function down(): void
    {
        Schema::table('pengunjung', function (Blueprint $table) {
            $table->string('waktu_kunjungan')->change(); // revert ke varchar jika rollback
        });
    }
};

