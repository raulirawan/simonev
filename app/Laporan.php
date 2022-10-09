<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'karyawan_id',
        'kode_laporan',
        'deskripsi',
        'kategori',
        'kelurahan_asal',
        'skpd',
        'tanggal_laporan',
        'tanggal_status_terakhir',
        'catatan',
        'status',
    ];

    public function pegawai()
    {
        return $this->belongsTo(User::class, 'karyawan_id', 'id');
    }
}
