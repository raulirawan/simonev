<?php

namespace App\Http\Controllers\Admin;

use App\Golongan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GolonganRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Golongan::query();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <a href="' . route('admin.golongan.edit', $item->id) . '"
                    class="btn btn-info btn-sm">Edit</a>
                <button id="delete-button" data-id="' . $item->id . '"  class="btn btn-danger btn-sm">Hapus</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.golongan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.golongan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_golongan' => 'required|unique:golongan,nama_golongan',
        ]);
        $data = $request->all();

        if (Golongan::create($data)) {
            Alert::success('Success', 'Data Berhasil di Tambahkan');
            return redirect()->route('admin.golongan.index');
        }
        Alert::error('Error', 'Data Gagal di Tambahkan');
        return redirect()->route('admin.golongan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Golongan  $golongan
     * @return \Illuminate\Http\Response
     */
    public function show(Golongan $golongan)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Golongan  $golongan
     * @return \Illuminate\Http\Response
     */
    public function edit(Golongan $golongan)
    {
        return view('admin.golongan.edit', compact('golongan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Golongan  $golongan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Golongan $golongan)
    {
        $request->validate([
            'nama_golongan' => 'required|unique:golongan,nama_golongan,' . $golongan->id . ''
        ]);

        if ($golongan->update($request->all())) {
            Alert::success('Success', 'Data Berhasil di Update');
            return redirect()->route('admin.golongan.index');
        };
        Alert::error('Error', 'Data Gagal di Update');
        return redirect()->route('admin.golongan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Golongan  $golongan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Golongan $golongan)
    {
        if ($golongan->delete()) {
            return response()->json([
                'status' => 'success',
            ]);
        }
        return response()->json([
            'status' => 'error',
        ]);
    }
}
