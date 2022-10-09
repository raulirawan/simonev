@extends('layouts.admin')

@section('title', 'Halaman Data Transaksi')

@section('content')
<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Data Transaksi</h3>

        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav
            aria-label="breadcrumb"
            class="breadcrumb-header float-start float-lg-end"
          >
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Data Transaksi
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
      <div class="card">

        <div class="card-header">Tabel Transaksi</div>
        <div class="card-body">
    <!--Basic Modal -->
        <div class="row input-daterange ml-2 my-2">
            <div class="col-md-3">
                <input type="date" name="from_date" id="from_date" value="{{ date('Y-m-d', strtotime('-7 days')) }}" class="form-control"
                    placeholder="From Date" />
            </div>
            <div class="col-md-3">
                <input type="date" name="to_date" id="to_date"  value="{{ date('Y-m-d') }}" class="form-control"
                    placeholder="To Date" />
            </div>
            <div class="col-md-3">
                <select name="status_transaksi" id="status_transaksi" class="form-control">
                    <option value="SEMUA">SEMUA</option>
                    <option value="SUCCESS">SUCCESS</option>
                    <option value="PENDING">PENDING</option>
                    <option value="CHECK IN">CHECK IN</option>
                    <option value="CHECK OUT">CHECK OUT</option>
                    <option value="CANCELLED">CANCELLED</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" name="filter" id="filter" class="btn btn-primary">Filter</button>
                <button type="button" name="refresh" id="refresh"
                    class="btn btn-default">Refresh</button>
            </div>

        </div>
         <div class="table-responsive">
            <table class="table" id="table-data">
                <thead>
                  <tr>
                    <th style="width: 10%">Tanggal</th>
                    <th>Kode</th>
                    <th>Nama Pengunjung</th>
                    <th>Nama Kamar</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Status</th>
                    <th>Total Harga</th>
                    <th style="width: 15%">Aksi</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7">Total</th>
                        <th id="total"></th>
                    </tr>
                </tfoot>
              </table>
         </div>
        </div>
      </div>
    </section>
    <!-- Basic Tables end -->
  </div>


  <div class="modal fade text-left" id="modal-detail" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
      <form action="#" id="form-edit" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel1">Detail Transaksi Pengunjung</h5>
                  <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                      aria-label="Close">
                      <i data-feather="x"></i>
                  </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                       <table class="table">
                            <tr>
                                <th>Tanggal Transaksi</th>
                                <td id="tanggal_transaksi"></td>
                            </tr>
                            <tr>
                                <th>Kode Transaksi</th>
                                <td id="kode_transaksi"></td>
                            </tr>
                            <tr>
                                <th>Nama Pengunjung</th>
                                <td id="nama_pengunjung"></td>
                            </tr>
                            <tr>
                                <th>Nama Kamar</th>
                                <td id="nama_kamar"></td>
                            </tr>
                            <tr>
                                <th>Tipe Kamar</th>
                                <td id="tipe_kamar"></td>
                            </tr>
                             <tr>
                                <th>Jenis Bed</th>
                                <td id="jenis_bed"></td>
                            </tr>
                            <tr>
                                <th>Tanggal Check In</th>
                                <td id="tanggal_check_in"></td>
                            </tr>
                             <tr>
                                <th>Tanggal Check Out</th>
                                <td id="tanggal_check_out"></td>
                            </tr>
                            <tr>
                                <th>Jumlah Kamar</th>
                                <td id="jumlah_kamar"></td>
                            </tr>
                             <tr>
                                <th>Dewasa</th>
                                <td id="adult"></td>
                            </tr>
                            <tr>
                                <th>Anak - Anak</th>
                                <td id="children"></td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td id="total_harga"></td>
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
                  <button type="button" class="btn" data-bs-dismiss="modal">
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
<link rel="stylesheet" href="{{ asset('assets') }}/css/pages/datatables.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  @endpush
  @push('down-script')
  <script src="{{ asset('assets') }}/js/extensions/datatables.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>

    <script>
         $(document).ready(function() {
            function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            function statusTransaksi(status) {
                if (status == 'CHECK IN') {
                        return '<span class="badge bg-success">CHECK IN</span>';
                } else if (status == 'CHECK OUT') {
                    return '<span class="badge bg-danger">CHECK OUT</span>';
                } else if (status == 'PENDING') {
                    return '<span class="badge bg-warning">PENDING</span>';
                } else if (status == 'SUCCESS') {
                    return '<span class="badge bg-success">SUCCESS</span>';
                } else {
                    return '<span class="badge badge-danger">CANCELLED</span>';
                }
            }
            $(document).on('click', '#detail', function() {
                $('#status').empty();

                var tanggal_transaksi = $(this).data('tanggal_transaksi');
                var kode_transaksi = $(this).data('kode_transaksi');
                var nama_pengunjung = $(this).data('nama_pengunjung');
                var nama_kamar = $(this).data('nama_kamar');
                var tipe_kamar = $(this).data('tipe_kamar');
                var jenis_bed = $(this).data('jenis_bed');
                var tanggal_check_in = $(this).data('tanggal_check_in');
                var tanggal_check_out = $(this).data('tanggal_check_out');
                var jumlah_kamar = $(this).data('jumlah_kamar');
                var adult = $(this).data('adult');
                var children = $(this).data('children');
                var total_harga = $(this).data('total_harga');
                var status = $(this).data('status');

                $('#tanggal_transaksi').text(tanggal_transaksi);
                $('#kode_transaksi').text(kode_transaksi);
                $('#nama_pengunjung').text(nama_pengunjung);
                $('#nama_kamar').text(nama_kamar);
                $('#tipe_kamar').text(tipe_kamar);
                $('#jenis_bed').text(jenis_bed);
                $('#tanggal_check_in').text(tanggal_check_in);
                $('#tanggal_check_out').text(tanggal_check_out);
                $('#jumlah_kamar').text(jumlah_kamar + ' Kamar');
                $('#adult').text(adult + ' Orang');
                $('#children').text(children + ' Orang');
                $('#total_harga').text('Rp'+numberWithCommas(total_harga));
                $('#status').append(statusTransaksi(status));
            });
            var status_transaksi = $('select[name=status_transaksi] option').filter(':selected').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            load_data(from_date, to_date, status_transaksi);

            $('#filter').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                var status_transaksi = $('select[name=status_transaksi] option').filter(':selected').val();
                if (from_date != '' && to_date != '') {
                    $('#table-data').DataTable().destroy();
                    load_data(from_date, to_date, status_transaksi);
                } else {
                    alert('Silahkan Pilih Tanggal')
                }
            });

            $('#refresh').click(function() {
                var status_transaksi = $('select[name=status_transaksi] option').filter(':selected').val();
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                $('#table-data').DataTable().destroy();
                load_data(from_date, to_date, status_transaksi);
            });

            function load_data(from_date = '', to_date = '', status_transaksi = '') {
                var datatable = $('#table-data').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    ajax: {
                        url: '{!! url()->current() !!}',
                        type: 'GET',
                        data: {
                            from_date: from_date,
                            to_date: to_date,
                            status_transaksi: status_transaksi,
                        }
                    },
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'potrait',
                            footer: true,
                        },
                        {
                            extend: 'excelHtml5',
                            footer: true,
                        }
                    ],

                    columns: [
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'kode_transaksi',
                            name: 'kode_transaksi'
                        },
                        {
                            data: 'pengunjung.name',
                            name: 'pengunjung.name'
                        },

                        {
                            data: 'kamar.nama_kamar',
                            name: 'kamar.nama_kamar'
                        },

                        {
                            data: 'tanggal_check_in',
                            name: 'tanggal_check_in'
                        },
                        {
                            data: 'tanggal_check_out',
                            name: 'tanggal_check_out'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'total_harga',
                            name: 'total_harga',
                            render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searcable: false,
                            width: '10%',
                        }
                    ],

                    "footerCallback": function(row, data) {
                        var api = this.api(),
                            data;

                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };

                        total = api
                            .column(7)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        price = api
                            .column(7, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        $(api.column(7).footer()).html(
                            'Rp' + price
                        );

                        var numFormat = $.fn.dataTable.render.number('\,', 'Rp').display;
                        $(api.column(7).footer()).html(
                            'Rp ' + numFormat(price)
                        );
                    }

                });
            }


        });
    </script>
  @endpush

@endsection
