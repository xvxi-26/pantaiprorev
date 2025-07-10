<div class="grid grid-cols-1 gap-4">
    <div>
        <label for="nama" class="block font-semibold mb-1">Nama</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $pengunjung->nama ?? '') }}"
               class="w-full px-4 py-2 border rounded dark:bg-gray-900 dark:border-gray-700" required>
    </div>

    <div>
        <label for="alamat" class="block font-semibold mb-1">Alamat</label>
        <textarea name="alamat" id="alamat" rows="2"
                  class="w-full px-4 py-2 border rounded dark:bg-gray-900 dark:border-gray-700" required>{{ old('alamat', $pengunjung->alamat ?? '') }}</textarea>
    </div>

    <div>
        <label for="notelp" class="block font-semibold mb-1">No Telepon</label>
        <input type="text" name="notelp" id="notelp" value="{{ old('notelp', $pengunjung->notelp ?? '') }}"
               class="w-full px-4 py-2 border rounded dark:bg-gray-900 dark:border-gray-700" required>
    </div>

    <div>
        <label for="wisata_id" class="block font-semibold mb-1">Wisata Tujuan</label>
        <select name="wisata_id" id="wisata_id"
                class="w-full px-4 py-2 border rounded dark:bg-gray-900 dark:border-gray-700" required>
            <option value="">-- Pilih Wisata --</option>
            @foreach($wisata as $w)
                <option value="{{ $w->id }}" {{ old('wisata_id', $pengunjung->wisata_id ?? '') == $w->id ? 'selected' : '' }}>
                    {{ $w->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="waktu_kunjungan" class="block font-semibold mb-1">Waktu Kunjungan</label>
        <input type="datetime-local" name="waktu_kunjungan" id="waktu_kunjungan"
               value="{{ old('waktu_kunjungan', isset($pengunjung) ? \Carbon\Carbon::parse($pengunjung->waktu_kunjungan)->format('Y-m-d\TH:i') : '') }}"
               class="w-full px-4 py-2 border rounded dark:bg-gray-900 dark:border-gray-700" required>
    </div>

    <div>
        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Simpan
        </button>
    </div>
</div>
