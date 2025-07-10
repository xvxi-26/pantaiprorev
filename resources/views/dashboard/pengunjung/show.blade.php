@extends('dashboard.layouts.admin')

@section('title', 'Detail Pengunjung')

@section('content')
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow space-y-4">
        <div><strong>Nama:</strong> {{ $pengunjung->nama }}</div>
        <div><strong>Alamat:</strong> {{ $pengunjung->alamat }}</div>
        <div><strong>No Telepon:</strong> {{ $pengunjung->notelp }}</div>
        <div><strong>Wisata Tujuan:</strong> {{ $pengunjung->wisata->nama ?? '-' }}</div>
        <div><strong>Waktu Kunjungan:</strong> {{ \Carbon\Carbon::parse($pengunjung->waktu_kunjungan)->translatedFormat('d F Y H:i') }}</div>

        <div class="mt-4">
            <a href="{{ route('pengunjung.edit', $pengunjung->id) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('pengunjung.index') }}"
               class="ml-2 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Kembali</a>
        </div>
    </div>
@endsection
