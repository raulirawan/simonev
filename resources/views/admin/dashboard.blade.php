

@extends('layouts.admin')

@section('title', 'Halaman Data Laporan')

<style>
    .detail-laporan th {
        width: 200px !important;
    }
</style>
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Laporan</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Data Laporan
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="bi bi-house-fill" style="width: auto; height: auto;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Laporan Selesai</h6>
                                        <h6 class="font-extrabold mb-0">{{ App\Laporan::where('status', 0)->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="bi bi-house-fill" style="width: auto; height: auto;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Laporan Di Tolak</h6>
                                        <h6 class="font-extrabold mb-0">{{ App\Laporan::where('status', 1)->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">

                        <div class="card-header">Tabel Laporan Selesai</div>
                        <div class="card-body">
                            <!--Basic Modal -->
                            <div class="table-responsive">
                                <table class="table table-striped w-100" id="table-data">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Laporan</th>
                                            <th>Kode Laporan</th>
                                            <th>Pegawai</th>
                                            <th>Kelurahan Asal</th>
                                            <th>Skpd</th>
                                            <th>Status Proses</th>
                                            <th style="width: 15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

        </section>
    </div>

    {{-- modal import --}}

    <div class="modal fade text-left" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <form action="{{ route('admin.laporan.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Form Import Data Laporan</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Dari Tanggal</label>
                                    <input type="date" name="from_date" class="form-control" value="{{ date('Y-m-d') }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Sampai Tanggal</label>
                                    <input type="date" name="to_date" class="form-control"
                                        value="{{ date('Y-m-d', strtotime('+1 days')) }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">File Excel</label>
                                    <input type="file" class="form-control" name="file_excel" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Import</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- modal export --}}

    <div class="modal fade text-left" id="modal-export" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <form action="{{ route('admin.laporan.export') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Form Export Data Laporan</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Dari Tanggal</label>
                                    <input type="date" name="from_date" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Sampai Tanggal</label>
                                    <input type="date" name="to_date" class="form-control"
                                        value="{{ date('Y-m-d', strtotime('+1 days')) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Export</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- modal detail --}}

    <div class="modal fade text-left" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <form action="#" id="form-edit" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Detail Laporan</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table detail-laporan">
                                    <tr>
                                        <th>Tanggal Laporan</th>
                                        <td id="tanggal_laporan"></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Status Terakhir</th>
                                        <td id="tanggal_status_terakhir"></td>
                                    </tr>
                                    <tr>
                                        <th>Pegawai</th>
                                        <td id="pegawai"></td>
                                    </tr>
                                    <tr>
                                        <th>Kode Laporan</th>
                                        <td id="kode_laporan"></td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td id="deskripsi"></td>
                                    </tr>

                                    <tr>
                                        <th>Kategori</th>
                                        <td id="kategori"></td>
                                    </tr>
                                    <tr>
                                        <th>Kelurahan Asal</th>
                                        <td id="kelurahan_asal"></td>
                                    </tr>
                                    <tr>
                                        <th>Skpd</th>
                                        <td id="skpd"></td>
                                    </tr>
                                    <tr>
                                        <th>Catatan</th>
                                        <td id="catatan"></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td id="status"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @push('down-style')
        <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/fontawesome.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    @endpush
    @push('down-script')
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function() {
                function statusLaporan(status) {
                    if (status == 2) {
                        return '<span class="badge bg-success">SELESAI</span>';
                    } else {
                        return '<span class="badge bg-danger">Di Tolak</span>';
                    }
                }
                var datatable = $('#table-data').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    responsive: true,
                    ajax: {
                        url: `${window.location.origin}/admin/dashboard`,
                        type: 'GET',
                    },
                    columns: [{
                            data: 'tanggal_status_terakhir',
                            name: 'tanggal_status_terakhir',
                            width: '15%',
                        },
                        {
                            data: 'kode_laporan',
                            name: 'kode_laporan'
                        },
                        {
                            data: 'pegawai',
                            name: 'pegawai'
                        },
                        {
                            data: 'kelurahan_asal',
                            name: 'kelurahan_asal'
                        },
                        {
                            data: 'skpd',
                            name: 'skpd'
                        },
                        {
                            data: 'status_proses',
                            name: 'status_proses'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searcable: false,
                            width: '20%',
                        }
                    ],


                });

                $(document).on('click', '#detail', function() {
                    $('#status').empty();

                    var tanggal_laporan = $(this).data('tanggal_laporan');
                    var tanggal_status_terakhir = $(this).data('tanggal_status_terakhir');
                    var pegawai = $(this).data('pegawai');
                    var kode_laporan = $(this).data('kode_laporan');
                    var deskripsi = $(this).data('deskripsi');
                    var kategori = $(this).data('kategori');
                    var kelurahan_asal = $(this).data('kelurahan_asal');
                    var skpd = $(this).data('skpd');
                    var catatan = $(this).data('catatan');
                    var status = $(this).data('status');



                    $('#tanggal_laporan').text(tanggal_laporan);
                    $('#tanggal_status_terakhir').text(tanggal_status_terakhir);
                    $('#pegawai').text(pegawai);
                    $('#kode_laporan').text(kode_laporan);
                    $('#deskripsi').text(deskripsi);
                    $('#kategori').text(kategori);
                    $('#kelurahan_asal').text(kelurahan_asal);
                    $('#skpd').text(skpd);
                    $('#catatan').text(catatan);
                    $('#status').append(statusLaporan(status));
                });

                $(document).on('click', '#delete-button', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: `${window.location.origin}/admin/laporan/${id}`,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(data) {
                                    if (data.status == 'success') {
                                        Swal.fire(
                                            'Deleted!',
                                            'Your file has been deleted.',
                                            'success'
                                        )
                                        parent.$("#table-data").DataTable().ajax.reload();
                                    } else {
                                        Swal.fire(
                                            'Failed!',
                                            'Your file has fail Delete.',
                                            'error'
                                        )
                                    }
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    Swal.fire(
                                        'Failed!',
                                        'Your file has fail Delete.',
                                        'error'
                                    )
                                },

                            });
                        }
                    })
                });

            });
        </script>
    @endpush

@endsection
