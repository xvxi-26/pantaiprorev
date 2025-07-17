<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambahkan kolom admin_id (nullable sementara)
        Schema::table('galeri', function (Blueprint $table) {
            $table->foreignId('admin_id')->nullable()->after('id');
        });

        // 2. Isi admin_id dengan nilai default 1
        DB::table('galeri')->update(['admin_id' => 1]);

        // 3. Tambahkan foreign key constraint
        Schema::table('galeri', function (Blueprint $table) {
            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
    }
};
