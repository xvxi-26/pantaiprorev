<div class="grid grid-cols-1 gap-4">
    <div>
        <label for="nama" class="block font-semibold mb-1">Nama</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $pengunjung->nama ?? '') }}"
               class="w-full px-4 py-2 border rounded dark:bg-gray-900 dark:border-gray-700" required>
        @error('nama')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="alamat" class="block font-semibold mb-1">Alamat</label>
        <textarea name="alamat" id="alamat" rows="2"
                  class="w-full px-4 py-2 border rounded dark:bg-gray-900 dark:border-gray-700" required>{{ old('alamat', $pengunjung->alamat ?? '') }}</textarea>
        @error('alamat')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="notelp" class="block font-semibold mb-1">No Telepon</label>
        <input type="text" name="notelp" id="notelp" value="{{ old('notelp', $pengunjung->notelp ?? '') }}"
               class="w-full px-4 py-2 border rounded dark:bg-gray-900 dark:border-gray-700" required>
        @error('notelp')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Simpan
        </button>
    </div>
</div>
