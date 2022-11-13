<?php

namespace App\Http\Controllers\Admin;

use App\Laporan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Laporan::query();
            $query->with(['pegawai']);
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    $pegawai = $item->pegawai->name ?? 'Tidak Ada';
                    $catatan = $item->catatan ?? 'Tidak Ada';
                    return '
                    <button
                    id="detail"
                    data-bs-toggle="modal"
                    data-bs-target="#modal-detail"
                    class="btn btn-info btn-sm"
                    data-pegawai="' . $pegawai . '"
                    data-kode_laporan="' . $item->kode_laporan . '"
                    data-deskripsi="' . $item->deskripsi . '"
                    data-kategori="' . $item->kategori . '"
                    data-kelurahan_asal="' . $item->kelurahan_asal . '"
                    data-skpd="' . $item->skpd . '"
                    data-tanggal_laporan="' . $item->tanggal_laporan . '"
                    data-tanggal_status_terakhir="' . $item->tanggal_status_terakhir . '"
                    data-catatan="' . $catatan . '"
                    data-status="' . $item->status . '"
                    >Detail</button>
                    ';
                })
                ->addColumn('status_proses', function ($item) {
                    if ($item->status == 2) {
                        return '<span class="badge bg-success">SELESAI</span>';
                    }
                    if ($item->status == 1) {
                        return '<span class="badge bg-success">PROSES SELESAI</span>';
                    } else {
                        return '<span class="badge bg-danger">Di Tolak</span>';
                    }
                    // return $item->status;
                })
                ->addColumn('pegawai', function ($item) {
                    return $item->pegawai->name ?? 'Tidak Ada';
                })
                ->rawColumns(['action', 'status_proses'])
                ->make();
        }
        return view('admin.dashboard');
    }
}
