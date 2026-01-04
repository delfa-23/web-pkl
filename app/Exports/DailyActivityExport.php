<?php

namespace App\Exports;

use App\Models\DailyActivity;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DailyActivityExport implements FromCollection, WithHeadings, WithMapping
{
    protected $siswaId;

    public function __construct($siswaId)
    {
        $this->siswaId = $siswaId;
    }

    public function collection()
    {
        return DailyActivity::with('siswa')
            ->where('login_id', $this->siswaId)
            ->where('status_verifikasi', 'diterima')
            ->orderBy('tanggal')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Siswa',
            'Kegiatan',
            'Deskripsi Kegiatan',
            'Waktu Mulai',
            'Waktu Selesai',
        ];
    }

    public function map($a): array
    {
        return [
            Carbon::parse($a->tanggal)->format('d-m-Y'),
            $a->siswa->nama ?? '-',
            $a->kegiatan,
            $a->deskripsi,
            $a->waktu_mulai,
            $a->waktu_selesai,
        ];
    }
}
