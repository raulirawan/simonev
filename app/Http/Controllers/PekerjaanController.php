<?php

namespace App\Http\Controllers;

use App\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PekerjaanController extends Controller
{
    public function indexPending()
    {
        if (request()->ajax()) {
            $query = Laporan::query();
            $query->with(['pegawai'])->where('karyawan_id', Auth::user()->id)->where('status', 0);
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    $pegawai = $item->pegawai->name ?? 'Tidak Ada';
                    $catatan = $item->catatan ?? 'Tidak Ada';
                    return '
                    <button
                    id="btn-proses"
                    data-id="' . $item->id . '"
                    data-kode_laporan="' . $item->kode_laporan . '"
                    data-bs-toggle="modal"
                    data-bs-target="#modal-proses"
                    class="btn btn-primary btn-sm"
                    >Proses</button>
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
                    if ($item->status == 1) {
                        return '<span class="badge bg-success">Proses</span>';
                    } else {
                        return '<span class="badge bg-warning">Pending</span>';
                    }
                })
                ->addColumn('pegawai', function ($item) {
                    return $item->pegawai->name ?? 'Tidak Ada';
                })
                ->rawColumns(['action', 'status_proses'])
                ->make();
        }

        return view('pekerjaan-pending');
    }

    public function indexSelesai()
    {
        if (request()->ajax()) {
            $query = Laporan::query();
            $query->with(['pegawai'])->where('karyawan_id', Auth::user()->id)->where('status', 1);
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
                    if ($item->status == 1) {
                        return '<span class="badge bg-success">Proses</span>';
                    } else {
                        return '<span class="badge bg-warning">Pending</span>';
                    }
                })
                ->addColumn('pegawai', function ($item) {
                    return $item->pegawai->name ?? 'Tidak Ada';
                })
                ->rawColumns(['action', 'status_proses'])
                ->make();
        }
        return view('pekerjaan-selesai');
    }

    public function proses(Request $request, Laporan $laporan)
    {
        $data = [
            'catatan' => $request->catatan,
            'status' => 1,
        ];

        if ($laporan->update($data)) {
            Alert::success('Success', 'Data Berhasil di Update');
            return redirect()->route('pekerjaan.pending.index');
        };
        Alert::error('Error', 'Data Gagal di Update');
        return redirect()->route('pekerjaan.pending.index');
    }
}
