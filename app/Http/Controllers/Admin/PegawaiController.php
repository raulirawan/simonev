<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = User::query();
            $query->with(['golongan'])->where('roles', 'PEGAWAI');
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <a href="' . route('admin.pegawai.edit', $item->id) . '"
                    class="btn btn-info btn-sm">Edit</a>
                <button id="delete-button" data-id="' . $item->id . '"  class="btn btn-danger btn-sm">Hapus</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.pegawai.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['roles'] = 'PEGAWAI';
        if (User::create($data)) {
            Alert::success('Success', 'Data Berhasil di Tambahkan');
            return redirect()->route('admin.pegawai.index');
        }
        Alert::error('Error', 'Data Gagal di Tambahkan');
        return redirect()->route('admin.pegawai.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $pegawai)
    {
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $pegawai)
    {
        $request->validate([
            'email' => 'required|unique:users,email,' . $pegawai->id . ''
        ]);
        $data = $request->all();

        if (!$data['password']) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($request->password);
        }

        if ($pegawai->update($data)) {
            Alert::success('Success', 'Data Berhasil di Tambahkan');
            return redirect()->route('admin.pegawai.index');
        }
        Alert::error('Error', 'Data Gagal di Tambahkan');
        return redirect()->route('admin.pegawai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $pegawai)
    {
        if ($pegawai->delete()) {
            return response()->json([
                'status' => 'success',
            ]);
        }
        return response()->json([
            'status' => 'error',
        ]);
    }
}
