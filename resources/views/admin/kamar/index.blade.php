@extends('layouts.admin')

@section('title', 'Halaman Data Kamar')

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

                <div class="card-header">Tabel Kamar</div>
                <div class="card-body">
                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                        data-bs-target="#modal-create">
                        Tambah Kamar
                    </button>

                    <!--Basic Modal -->

                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama Kamar</th>
                                    <th>Tipe Kamar</th>
                                    <th>Jenis Bed</th>
                                    <th>Harga</th>
                                    {{-- <th>Stok</th> --}}
                                    <th>Gambar</th>
                                    <th style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kamar as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_kamar }}</td>
                                        <td>{{ $item->tipe_kamar }}</td>
                                        <td>{{ $item->jenis_bed }}</td>
                                        <td>Rp{{ number_format($item->harga) }}</td>
                                        {{-- <td>{{ $item->stok }}</td> --}}
                                        <td>
                                            @php
                                                $gambar = json_decode($item->gambar);
                                            @endphp
                                            <img src="{{ asset($gambar[0] ?? '') }}" style="width: 100px">
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.kamar.edit', $item->id) }}" class="btn btn-info btn-sm">Edit</a>
                                            <a href="{{ route('admin.kamar.delete', $item->id) }}"
                                                onclick="return confirm('Yakin ?')" class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>

    <div class="modal fade text-left" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <form action="{{ route('admin.kamar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Form Tambah Data Kamar</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Nama Kamar</label>
                                    <input type="text" class="form-control" value="{{ old('nama_kamar') }}"
                                        name="nama_kamar" placeholder="Masukan Nama Kamar" required>
                                </div>

                                <div class="form-group">
                                    <label for="helpInputTop">Tipe Kamar</label>
                                    <select name="tipe_kamar" id="tipe_kamar" class="form-control" required>
                                        <option value="">Pilih Tipe Kamar</option>
                                        <option value="Gold" @if (old('tipe_kamar') == 'Gold') selected="selected" @endif >Gold</option>
                                        <option value="Silver"@if (old('tipe_kamar') == 'Silver') selected="selected" @endif>Silver</option>
                                        <option value="Bronze"@if (old('tipe_kamar') == 'Bronze') selected="selected" @endif>Bronze</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="helpInputTop">Jenis Bed</label>
                                    <select name="jenis_bed" id="jenis_bed" class="form-control" required>
                                        <option value="">Pilih Jenis Bed</option>
                                        <option value="Twin" @if (old('jenis_bed') == 'Twin') selected="selected" @endif>Twin</option>
                                        <option value="Double" @if (old('jenis_bed') == 'Double') selected="selected" @endif>Double</option>
                                        <option value="Big" @if (old('jenis_bed') == 'Big') selected="selected" @endif>Big</option>
                                        <option value="Small" @if (old('jenis_bed') == 'Small') selected="selected" @endif>Small</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="basicInput">Luas</label>
                                    <input type="number" class="form-control" value="{{ old('luas') }}" name="luas"
                                        placeholder="Masukan Luas Kamar" required>
                                    <div class="text-muted">Dalam Satuan m2</div>
                                </div>
                                <div class="form-group">
                                    <label for="basicInput">Harga / Malam</label>
                                    <input type="number" class="form-control" value="{{ old('harga') }}" name="harga"
                                        placeholder="Masukan Harga Kamar" required>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="basicInput">Stok Kamar</label>
                                    <input type="number" class="form-control" value="{{ old('stok') }}" name="stok"
                                        placeholder="Masukan Stok Kamar" required>
                                </div> --}}

                                <div class="form-group">
                                    <label for="helpInputTop">Gambar</label>
                                    <input type="file" class="form-control" name="gambar[]"
                                    multiple required>
                                    @if ($errors->has('gambar.*'))
                                    <span class="text-danger">{{ $errors->first('gambar.*') }}</span>
                                    @else
                                    <div class="text-muted">Gambar Bisa Lebih Dari Satu</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="helpInputTop">Pilih Services</label>
                                    <select class="choices form-select" name="services[]" multiple="multiple" required>
                                        <option value="AC">AC</option>
                                        <option value="WiFi">WiFi</option>
                                        <option value="Service 24 Jam">Service 24 Jam</option>
                                        <option value="TV">TV</option>
                                        <option value="Lemari">Lemari</option>
                                    </select>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @push('down-style')
        <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/fontawesome.css" />
        <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/datatables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    @endpush
    @push('down-script')
        <script src="{{ asset('assets') }}/js/extensions/datatables.js"></script>
        @if (count($errors) > 0)
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#modal-create').modal('show');
                });
            </script>
        @endif
    @endpush

@endsection
