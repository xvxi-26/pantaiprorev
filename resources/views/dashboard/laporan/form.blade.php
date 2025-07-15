@extends('dashboard.layouts.admin')

@section('title', 'Cetak Laporan Pengunjung')

@section('content')
<div class="max-w-2xl bg-white dark:bg-gray-800 p-6 rounded shadow">
    <form action="{{ route('admin.laporan.cetak') }}" method="GET">
        @csrf

        <div class="mb-4">
            <label for="tanggal_awal" class="block font-semibold mb-1">Tanggal Awal</label>
            <input type="date" name="tanggal_awal" id="tanggal_awal" class="w-full p-2 border rounded dark:bg-gray-700" required>
        </div>

        <div class="mb-4">
            <label for="tanggal_akhir" class="block font-semibold mb-1">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="w-full p-2 border rounded dark:bg-gray-700" required>
        </div>

        <div class="mb-4">
            <label for="wisata_id" class="block font-semibold mb-1">Pilih Wisata (Opsional)</label>
            <select name="wisata_id" id="wisata_id" class="w-full p-2 border rounded dark:bg-gray-700">
                <option value="">Semua Wisata</option>
                @foreach($wisatas as $w)
                    <option value="{{ $w->id }}">{{ $w->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Format</label>
            <label class="inline-flex items-center mr-4">
                <input type="radio" name="format" value="pdf" class="form-radio" required>
                <span class="ml-2">PDF</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" name="format" value="excel" class="form-radio" required>
                <span class="ml-2">Excel</span>
            </label>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Cetak</button>
    </form>
</div>
@endsection
