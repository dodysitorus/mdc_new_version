<?php

namespace App\Exports;

use App\Models\Dokter;
use App\Models\Klinik;
use App\Models\Layanan;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PasienExport implements FromCollection,WithMapping,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pasien = Pasien::all();
        return collect($pasien);
    }
    public function map($pasien): array
    {
        return [
            $pasien->referal_id_mdc,
            $pasien->status_pasien,
            $pasien->nama,
            $pasien->tanggal_lahir,
            $pasien->usia,
            $pasien->telephone,
            $pasien->nama_layanan,
            $pasien->nama_dokter,
            $pasien->biaya,
            $pasien->cabang,
            $pasien->admin,
            $pasien->created_at
        ];
    }
    public function headings(): array
    {
        return [
            'id_referal',
            'status_pasien',
            'nama',
            'tanggal-lahir',
            'usia',
            'telephone',
            'nama_layanan',
            'nama_dokter',
            'biaya',
            'cabang',
            'admin',
            'tanggal-masuk'
        ];
    }
}
