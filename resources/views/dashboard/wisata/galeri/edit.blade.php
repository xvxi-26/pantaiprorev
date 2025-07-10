@extends('dashboard.layouts.admin')

@section('title', 'Edit Media Galeri')

@section('content')
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Edit Media: {{ $galeri->nama }}</h2>

    <form action="{{ route('wisata.galeri.update', [$wisata->id, $galeri->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')


        <div>
            <label for="gambar" class="block font-medium">Gambar Saat Ini</label>
            @if($galeri->url_gambar)
                <img src="{{ $galeri->url_gambar }}" alt="Gambar" class="w-40 h-auto mt-2 mb-2 rounded">
            @else
                <p class="text-sm text-gray-500">Tidak ada gambar.</p>
            @endif
            <input type="file" name="gambar" id="gambar" accept="image/*" class="mt-1 w-full">
        </div>

        <div>
            <label for="video" class="block font-medium">Video Saat Ini</label>
            @if($galeri->url_video)
                <video controls class="w-full mt-2 mb-2">
                    <source src="{{ $galeri->url_video }}" type="video/mp4">
                    Browser tidak mendukung video.
                </video>
            @else
                <p class="text-sm text-gray-500">Tidak ada video.</p>
            @endif
            <input type="file" name="video" id="video" accept="video/mp4,video/quicktime" class="mt-1 w-full">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('wisata.show', $wisata->id) }}" class="px-4 py-2 rounded bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-sm">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded text-sm">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
