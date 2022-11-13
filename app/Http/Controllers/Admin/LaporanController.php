<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LaporanExport;
use App\Laporan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LaporanImport;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Laporan::query();
            $query->with(['pegawai'])->where('status', 0);
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
                    <button id="delete-button" data-id="' . $item->id . '"  class="btn btn-danger btn-sm">Hapus</button>
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
                })
                ->addColumn('pegawai', function ($item) {
                    return $item->pegawai->name ?? 'Tidak Ada';
                })
                ->rawColumns(['action', 'status_proses'])
                ->make();
        }

        return view('admin.laporan.index');
    }

    public function import(Request $request)
    {
        try {
            $excel = Excel::import(new LaporanImport($request->from_date, $request->to_date), $request->file('file_excel'));
            if ($excel) {
                Alert::success('Success', 'Data Berhasil di Import');
                return redirect()->route('admin.laporan.index');
            }
            Alert::error('Error', 'Data Gagal di Import');
            return redirect()->route('admin.laporan.index');
        } catch (\Exception $e) {
            Alert::error(
                'Error',
                $e->getMessage()
            );
            return redirect()->route('admin.laporan.index');
        }
    }

    public function export(Request $request)
    {
        try {
            $excel = Excel::download(new LaporanExport($request->from_date, $request->to_date), 'laporan.xlsx');
            if ($excel) {
                Alert::success('Success', 'Data Berhasil di Import');
                return $excel;
            }
            Alert::error('Error', 'Data Gagal di Import');
            return redirect()->route('admin.laporan.index');
        } catch (\Exception $e) {
            Alert::error(
                'Error',
                $e->getMessage()
            );
            return redirect()->route('admin.laporan.index');
        }
    }


    public function destroy(Laporan $laporan)
    {
        if ($laporan->delete()) {
            return response()->json([
                'status' => 'success',
            ]);
        }
        return response()->json([
            'status' => 'error',
        ]);
    }
}
