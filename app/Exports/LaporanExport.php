<?php

namespace App\Exports;

use App\Laporan;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromCollection, WithHeadings, WithMapping
{
    private $from_date;
    private $to_date;

    public function __construct(string $from_date, string $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $laporan = Laporan::
                whereBetween('tanggal_status_terakhir', [$this->from_date, $this->to_date])
                ->where('status', 1)
                ->get();
        return $laporan;
    }

    public function map($laporan): array
    {
        return [
            $laporan->kode_laporan,
            $laporan->deskripsi,
            $laporan->kategori,
            $laporan->kelurahan_asal,
            $laporan->skpd,
            $laporan->tanggal_laporan,
            $laporan->tanggal_status_terakhir,
            $laporan->catatan,
        ];
    }

    public function headings(): array
    {
        return [
            "kode_laporan",
            "deskripsi",
            "kategori",
            "kelurahan_asal",
            "skpd",
            "tanggal_laporan",
            "tanggal_status_terakhir",
            "catatan",

        ];
    }
}
