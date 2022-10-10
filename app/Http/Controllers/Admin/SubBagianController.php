<?php

namespace App\Http\Controllers\Admin;

use App\SubBagian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubBagianRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class SubBagianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = SubBagian::query();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <a href="' . route('admin.sub-bagian.edit', $item->id) . '"
                    class="btn btn-info btn-sm">Edit</a>
                <button id="delete-button" data-id="' . $item->id . '"  class="btn btn-danger btn-sm">Hapus</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.sub-bagian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sub-bagian.create');
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
            'nama_sub_bagian' => 'required|unique:sub_bagian,nama_sub_bagian',
        ]);
        $data = $request->all();

        if (SubBagian::create($data)) {
            Alert::success('Success', 'Data Berhasil di Tambahkan');
            return redirect()->route('admin.sub-bagian.index');
        }
        Alert::error('Error', 'Data Gagal di Tambahkan');
        return redirect()->route('admin.sub-bagian.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubBagian  $subbagian
     * @return \Illuminate\Http\Response
     */
    public function show(SubBagian $subBagian)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubBagian  $subbagian
     * @return \Illuminate\Http\Response
     */
    public function edit(SubBagian $subBagian)
    {
        return view('admin.sub-bagian.edit', compact('subBagian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubBagian  $subbagian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubBagian $subBagian)
    {
        $request->validate([
            'nama_sub_bagian' => 'required|unique:sub_bagian,nama_sub_bagian,' . $subBagian->id . ''
        ]);

        if ($subBagian->update($request->all())) {
            Alert::success('Success', 'Data Berhasil di Update');
            return redirect()->route('admin.sub-bagian.index');
        };
        Alert::error('Error', 'Data Gagal di Update');
        return redirect()->route('admin.sub-bagian.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubBagian  $subbagian
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubBagian $subBagian)
    {
        if ($subBagian->delete()) {
            return response()->json([
                'status' => 'success',
            ]);
        }
        return response()->json([
            'status' => 'error',
        ]);
    }
}
