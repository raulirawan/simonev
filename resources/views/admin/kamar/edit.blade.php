@extends('layouts.admin')

@section('title', 'Halaman Edit Data Kamar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Kamar</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Data Kamar
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">

                <div class="card-header">Edit Data Kamar</div>
                <div class="card-body">
                    <form action="{{ route('admin.kamar.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Nama Kamar</label>
                                    <input type="text" class="form-control" value="{{ $data->nama_kamar }}" name="nama_kamar" placeholder="Masukan Nama Kamar">
                                </div>

                                <div class="form-group">
                                    <label for="helpInputTop">Tipe Kamar</label>
                                    <select name="tipe_kamar" id="tipe_kamar" class="form-control" required>
                                        <option value="">Pilih Tipe Kamar</option>
                                        <option value="Gold" {{ $data->tipe_kamar == 'Gold' ? 'selected' : '' }}>Gold</option>
                                        <option value="Silver" {{ $data->tipe_kamar == 'Silver' ? 'selected' : '' }}>Silver</option>
                                        <option value="Bronze" {{ $data->tipe_kamar == 'Bronze' ? 'selected' : '' }}>Bronze</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="helpInputTop">Jenis Bed</label>
                                    <select name="jenis_bed" id="jenis_bed" class="form-control" required>
                                        <option value="">Pilih Jenis Bed</option>
                                        <option value="Twin" {{ $data->jenis_bed == 'Twin' ? 'selected' : '' }}>Twin</option>
                                        <option value="Double" {{ $data->jenis_bed == 'Double' ? 'selected' : '' }}>Double</option>
                                        <option value="Big" {{ $data->jenis_bed == 'Big' ? 'selected' : '' }}>Big</option>
                                        <option value="Small" {{ $data->jenis_bed == 'Small' ? 'selected' : '' }}>Small</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="basicInput">Luas</label>
                                    <input type="number" class="form-control" value="{{ $data->luas }}" name="luas"
                                        placeholder="Masukan Luas Kamar" required>
                                    <div class="text-muted">Dalam Satuan m2</div>
                                </div>
                                <div class="form-group">
                                    <label for="basicInput">Harga / Malam</label>
                                    <input type="number" class="form-control" value="{{ $data->harga }}" name="harga"
                                        placeholder="Masukan Harga Kamar" required>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="basicInput">Stok Kamar</label>
                                    <input type="number" class="form-control" value="{{ $data->stok }}" name="stok"
                                        placeholder="Masukan Stok Kamar" required>
                                </div> --}}
                                <div class="form-group">
                                    @php
                                        $services = json_decode($data->services)
                                    @endphp
                                    <label for="helpInputTop">Pilih Services</label>
                                    <select class="choices form-select" name="services[]" multiple="multiple">
                                        @if(in_array('AC', $services))
                                        <option value="AC" selected>AC</option>
                                        @else
                                        <option value="AC">AC</option>
                                        @endif
                                        @if(in_array('WiFi', $services))
                                        <option value="WiFi" selected>WiFi</option>
                                        @else
                                        <option value="WiFi">WiFi</option>
                                        @endif
                                        @if(in_array('Service 24 Jam', $services))
                                        <option value="Service 24 Jam" selected>Service 24 Jam</option>
                                        @else
                                        <option value="Service 24 Jam">Service 24 Jam</option>
                                        @endif
                                        @if(in_array('TV', $services))
                                        <option value="TV" selected>TV</option>
                                        @else
                                        <option value="TV">TV</option>
                                        @endif
                                        @if(in_array('Lemari', $services))
                                        <option value="Lemari" selected>Lemari</option>
                                        @else
                                        <option value="Lemari">Lemari</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    @php
                                        $gambar = json_decode($data->gambar)
                                    @endphp
                                    <label for="helpInputTop">Gambar</label>

                                    <input type="file" class="form-control" name="gambar[]"
                                    multiple>
                                    @if ($errors->has('gambar.*'))
                                    <span class="text-danger">{{ $errors->first('gambar.*') }}</span>
                                    @else
                                    <div class="text-muted">Gambar Bisa Lebih Dari Satu</div>
                                    @endif

                                    <div class="row mt-4">
                                        @if ($gambar != null)
                                        @foreach ($gambar as $key => $val)
                                        <div class="col">
                                            <div class="image text-center">
                                                <img src="{{ asset($val) }}" alt="" class="img-fluid">
                                            <a href="{{ route('admin.kamar.delete.gambar', [$data->id, $key]) }}" onclick="return confirm('Yakin ?')" class="btn btn-block btn-sm mt-2 btn-danger">Hapus</a>
                                            </div>
                                         </div>
                                        @endforeach
                                        @else
                                        <div class="text-center">No Image</div>
                                        @endif
                                     </div>
                                </div>
                                <div class="col-sm-12 d-flex justify-content-start">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                    <a href="{{ route('admin.kamar.index') }}"
                                        class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>
@endsection
