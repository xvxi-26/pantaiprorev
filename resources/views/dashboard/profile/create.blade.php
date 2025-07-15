@extends('dashboard.layouts.admin')

@section('title', 'Tambah Profile')

@section('content')
<h2 class="text-xl font-semibold mb-6">Tambah Data Profile</h2>

<form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    <div>
        <label for="nama" class="block text-sm mb-1">Nama</label>
        <input type="text" id="nama" name="nama" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white" required>
    </div>

    <div>
        <label for="deskripsi" class="block text-sm mb-1">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="5" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white" required></textarea>
    </div>

    <div>
        <label for="url_gambar" class="block text-sm mb-1">Gambar</label>
        <input type="file" name="url_gambar" class="block w-full text-sm text-gray-700 dark:text-white">
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        <a href="{{ route('profile.index') }}" class="ml-2 text-sm text-gray-600 dark:text-gray-300 hover:underline">Batal</a>
    </div>
</form>
@endsection
