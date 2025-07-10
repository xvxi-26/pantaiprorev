@extends('dashboard.layouts.admin')

@section('title', 'Tambah Media Galeri')

@section('content')
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Tambah Gambar / Video untuk: {{ $wisata->nama }}</h2>

    <form action="{{ route('wisata.galeri.store', $wisata->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="gambar" class="block font-medium">Upload Gambar (Multiple)(opsional)</label>
            <input type="file" name="gambar[]" id="gambar" accept="image/*" multiple class="mt-1 w-full">
        </div>

        <div>
            <label for="video" class="block font-medium">Upload Video (Multiple)(opsional)(Max: 20MB)</label>
            <input type="file" name="video[]" id="video" accept="video/mp4,video/quicktime" multiple class="mt-1 w-full">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('wisata.show', $wisata->id) }}" class="px-4 py-2 rounded bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-sm">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
