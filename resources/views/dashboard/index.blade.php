@extends('dashboard.layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card Jumlah Pengunjung -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                    <i data-lucide="users" class="w-5 h-5"></i> Total Pengunjung
                </h2>
            </div>
            <p class="text-4xl font-bold text-blue-600 dark:text-blue-400">
                {{ $jumlahPengunjung }}
            </p>
        </div>

        <!-- Tambahkan lebih banyak card statistik di sini jika diperlukan -->
    </div>
@endsection
