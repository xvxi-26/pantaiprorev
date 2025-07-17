@extends('dashboard.layouts.admin')

@section('title', 'Tambah Wisata')

@section('content')
<h2 class="text-xl font-semibold mb-4">Tambah Wisata</h2>

<form action="{{ route('wisata.store') }}" method="POST" class="bg-white dark:bg-gray-800 shadow rounded p-6 space-y-4">
    @csrf

    <div>
        <label class="block mb-1">Nama Wisata</label>
        <input type="text" name="nama" class="w-full p-2 rounded border dark:bg-gray-900" required>
    </div>

    <div>
        <label class="block mb-1">Tarif (Rp)</label>
        <input type="number" name="tarif" class="w-full p-2 rounded border dark:bg-gray-900" required>
    </div>

    <div>
        <label class="block mb-1">Deskripsi</label>
        <textarea name="deskripsi" rows="3" class="w-full p-2 rounded border dark:bg-gray-900"></textarea>
    </div>

    <div>
        <label class="block mb-1">Fasilitas</label>
        <textarea name="fasilitas" rows="2" class="w-full p-2 rounded border dark:bg-gray-900"></textarea>
    </div>

    <div>
        <label class="block mb-1">Jam Buka</label>
        <input type="time" name="jam_buka" class="w-full p-2 rounded border dark:bg-gray-900" required>
    </div>

    <div>
        <label class="block mb-1">Jam Tutup</label>
        <input type="time" name="jam_tutup" class="w-full p-2 rounded border dark:bg-gray-900" required>
    </div>

    <div class="flex justify-end gap-2">
        <a href="{{ route('wisata.index') }}" class="px-4 py-2 border rounded">Batal</a>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
    </div>
</form>
@endsection
