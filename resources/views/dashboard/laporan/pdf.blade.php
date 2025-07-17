<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h2, p {
            margin: 0 0 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2>{{ $judul }}</h2>
    <p>{{ $periode }}</p>
    <p>Tanggal Cetak: {{ $tanggal }}</p>

    @if(request()->has('wisata_id') && request()->wisata_id)
        <p>Wisata: {{ optional($pengunjung->first()->wisata)->nama ?? '-' }}</p>
    @else
        <p>Wisata: Semua</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Wisata</th>
                <th>Nama Pengunjung</th>
                <th>Alamat</th>
                <th>No. Telp</th>
                <th>Waktu Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengunjung as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->wisata->nama ?? '-' }}</td>
                    <td>{{ $p->pengunjung->nama ?? '-' }}</td>
                    <td>{{ $p->pengunjung->alamat ?? '-' }}</td>
                    <td>{{ $p->pengunjung->notelp ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->waktu)->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data kunjungan pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
