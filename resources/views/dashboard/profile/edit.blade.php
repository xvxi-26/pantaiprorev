@extends('dashboard.layouts.admin')

@section('title', 'Edit Profile')

@section('content')
<h2 class="text-xl font-semibold mb-6">Edit Data Profile</h2>

<form action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div>
        <label for="nama" class="block text-sm mb-1">Nama</label>
        <input type="text" id="nama" name="nama" value="{{ $profile->nama }}" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white" required>
    </div>

    <div>
        <label for="deskripsi" class="block text-sm mb-1">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="5" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white" required>{{ $profile->deskripsi }}</textarea>
    </div>

    <div>
        <label class="block text-sm mb-1">Gambar Saat Ini</label>
        @if($profile->url_gambar)
            <img src="{{ asset($profile->url_gambar) }}" alt="Gambar" class="h-20 mb-2 rounded">
        @else
            <p class="text-gray-500 italic">Belum ada gambar</p>
        @endif
        <label for="url_gambar" class="block text-sm mb-1">Ganti Gambar</label>
        <input type="file" name="url_gambar" class="block w-full text-sm text-gray-700 dark:text-white">
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('profile.index') }}" class="ml-2 text-sm text-gray-600 dark:text-gray-300 hover:underline">Batal</a>
    </div>
</form>
@endsection
