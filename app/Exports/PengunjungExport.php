<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengunjungExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'Nama Wisata' => $item->wisata->nama ?? '-',
                'Nama Pengunjung' => $item->nama,
                'Alamat' => $item->alamat,
                'No. Telp' => $item->notelp,
                'Waktu Kunjungan' => $item->waktu_kunjungan,
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama Wisata', 'Nama Pengunjung', 'Alamat', 'No. Telp', 'Waktu Kunjungan'];
    }
}
