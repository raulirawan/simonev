<?php

namespace App\Imports;

use App\Golongan;
use App\User;
use DateTime;
use App\Laporan;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LaporanImport implements ToCollection, WithHeadingRow
{
    private $from_date;
    private $to_date;

    public function __construct(string $from_date, string $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        $data = collect($rows)->map(function ($item, $key) {
            return [
                'kode_laporan' => $item['kode_laporan'],
                'deskripsi' => $item['deskripsi'],
                'kategori' => $item['kategori'],
                'kelurahan_asal' => $item['kelurahan_asal'],
                'skpd' => $item['skpd'],
                'tanggal_laporan' => date('Y-m-d H:i:s', strtotime($item['tanggal_laporan'])),
                'tanggal_status_terakhir' => date('Y-m-d H:i:s', strtotime($item['tanggal_status_terakhir'])),
                'total_tl_ditolak' => $item['total_tl_ditolak'],
            ];
            return;
        })->all();

        $dataMap = collect($data);

        $from = $this->from_date . ' 00:00:00';
        $to = $this->to_date . ' 23:59:59';

        $dataLaporan = $dataMap->whereBetween('tanggal_status_terakhir', [$from, $to])
            ->whereNotNull('skpd');


        foreach ($dataLaporan as $row) {
            $golongan = Golongan::where('nama_golongan', $row['skpd'])->first() ?? NULL;
            Laporan::create([
                'karyawan_id' => ($golongan) ? User::where('sub_bagian_id', $golongan->sub_bagian_id)->first()->id ?? NULL : NULL,
                'kode_laporan' => $row['kode_laporan'],
                'deskripsi' => $row['deskripsi'],
                'kategori' => $row['kategori'],
                'kelurahan_asal' => $row['kelurahan_asal'],
                'skpd' => $row['skpd'],
                'status' => ($row['total_tl_ditolak'] == 0) ? 2 : 0,
                'tanggal_laporan' => $row['tanggal_laporan'],
                'tanggal_status_terakhir' => $row['tanggal_status_terakhir'],
            ]);
        }
    }
}
