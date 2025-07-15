@extends('dashboard.layouts.admin')

@section('title', 'Tambah Budaya')

@section('content')
    <form action="{{ route('budaya.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white dark:bg-gray-800 shadow rounded p-6 space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-medium">Nama Budaya</label>
            <input type="text" name="nama" value="{{ old('nama') }}"
                   class="w-full px-4 py-2 rounded border dark:border-gray-600 dark:bg-gray-900"
                   required>
            @error('nama') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                      class="w-full px-4 py-2 rounded border dark:border-gray-600 dark:bg-gray-900"
                      required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Upload Gambar</label>
            <input type="file" name="gambar" accept="image/*"
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                          file:rounded file:border-0 file:text-sm file:font-semibold
                          file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('gambar') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Upload Video</label>
            <input type="file" name="video" accept="video/*"
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                          file:rounded file:border-0 file:text-sm file:font-semibold
                          file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
            @error('video') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('budaya.index') }}"
               class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded hover:bg-gray-400 dark:hover:bg-gray-600">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i> Simpan
            </button>
        </div>
    </form>
@endsection
