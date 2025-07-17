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
        Schema::table('wisata', function (Blueprint $table) {
            $table->foreignId('admin_id')->nullable()->after('id'); // Tambah nullable dulu
        });

        // Lalu isi semua data `admin_id` sementara secara manual (misalnya ID admin default = 1)
        DB::table('wisata')->update(['admin_id' => 1]);

        // Baru tambahkan foreign key constraint
        Schema::table('wisata', function (Blueprint $table) {
            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wisata', function (Blueprint $table) {
            //
        });
    }
};
