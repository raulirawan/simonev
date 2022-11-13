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
                    <h3>Data Pekerjaan</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Data Pekerjaan Pending
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">

                <div class="card-header">Tabel Laporan</div>
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
        <!-- Basic Tables end -->
    </div>




    {{-- modal export --}}

    <div class="modal fade text-left" id="modal-proses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <form action="#" id="form-modal-proses" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="label-proses">Form Proses Data Laporan</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Catatan</label>
                                    <textarea name="catatan" class="form-control"></textarea>
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
                            <span class="d-none d-sm-block">Proses</span>
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
                    if (status == 1) {
                        return '<span class="badge bg-success">PROSES SELESAI</span>';
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
                        url: `${window.location.origin}/pekerjaan/pending`,
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

                $.validator.setDefaults({
                    highlight: function(element) {
                        $(element).addClass("is-invalid").removeClass("is-valid");
                    },
                    unhighlight: function(element) {
                        $(element).addClass("is-valid").removeClass("is-invalid");
                    },

                    //add
                    errorElement: 'span',
                    errorClass: 'text-danger',
                    errorPlacement: function(error, element) {
                        if (element.parent('.form-control').length) {
                            error.insertAfter(element.parent());
                        } else {
                            error.insertAfter(element);
                        }
                    }
                    // end add
                });
                $("#form-modal-proses").validate({
                    rules: {
                        catatan: {
                            required: true,
                            minlength: 3,
                        },
                    }
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

                $(document).on('click', '#btn-proses', function() {
                    var id = $(this).data('id');
                    var kode_laporan = $(this).data('kode_laporan');

                    $('#label-proses').text(`Form Proses Data Laporan #${kode_laporan}`);
                    $('#form-modal-proses').attr('action', '/pekerjaan/proses/' + id);
                });
            });
        </script>
    @endpush

@endsection
