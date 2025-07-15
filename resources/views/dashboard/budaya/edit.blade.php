@extends('dashboard.layouts.admin')

@section('title', 'Edit Budaya')

@section('content')
    <form action="{{ route('budaya.update', $budaya->id) }}" method="POST" enctype="multipart/form-data"
          class="bg-white dark:bg-gray-800 shadow rounded p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium">Nama Budaya</label>
            <input type="text" name="nama" value="{{ old('nama', $budaya->nama) }}"
                   class="w-full px-4 py-2 rounded border dark:border-gray-600 dark:bg-gray-900"
                   required>
            @error('nama') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                      class="w-full px-4 py-2 rounded border dark:border-gray-600 dark:bg-gray-900"
                      required>{{ old('deskripsi', $budaya->deskripsi) }}</textarea>
            @error('deskripsi') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Gambar Sekarang (gambar akan diganti yang baru)</label>
            @if ($budaya->url_gambar)
                <img src="{{ $budaya->url_gambar }}" alt="Gambar Budaya" class="w-32 h-20 object-cover rounded mb-2">
            @else
                <p class="italic text-sm text-gray-500">Tidak ada gambar.</p>
            @endif
            <input type="file" name="gambar" accept="image/*"
                   class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                          file:rounded file:border-0 file:text-sm file:font-semibold
                          file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <div>
            <label class="block mb-1 font-medium">Video Sekarang (video akan diganti yang baru)</label>
            @if ($budaya->url_video)
                <video src="{{ $budaya->url_video }}" controls class="w-64 h-36 rounded mb-2"></video>
            @else
                <p class="italic text-sm text-gray-500">Tidak ada video.</p>
            @endif
            <input type="file" name="video" accept="video/*"
                   class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                          file:rounded file:border-0 file:text-sm file:font-semibold
                          file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('budaya.index') }}"
               class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded hover:bg-gray-400 dark:hover:bg-gray-600">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i> Update
            </button>
        </div>
    </form>
@endsection
