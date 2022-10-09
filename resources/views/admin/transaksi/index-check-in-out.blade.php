@extends('layouts.admin')

@section('title', 'Halaman Data Data Check In/Out')

@section('content')
<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Data {{ request()->is('admin/transaksi/check-in') ? 'Check In' : 'Check Out' }}
        </h3>

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
                Data {{ request()->is('admin/transaksi/check-in') ? 'Check In' : 'Check Out' }}
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
      <div class="card">

        <div class="card-header">
            Data {{ request()->is('admin/transaksi/check-in') ? 'Check In' : 'Check Out' }}
        </div>
        <div class="card-body">


    <!--Basic Modal -->

         <div class="table-responsive">
            <table class="table" id="table1">
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                       <td>{{ $item->created_at }}</td>
                       <td>{{ $item->kode_transaksi }}</td>
                       <td>{{ $item->pengunjung->name }}</td>
                       <td>{{ $item->kamar->nama_kamar }}</td>
                       <td>{{ $item->tanggal_check_in }}</td>
                       <td>{{ $item->tanggal_check_out }}</td>
                       <td>
                           @if($item->status == 'CHECK IN')
                           <span class="badge bg-success">CHECK IN</span>
                           @elseif($item->status == 'CHECK OUT')
                               <span class="badge bg-danger">CHECK OUT</span>
                           @elseif($item->status == 'PENDING')
                               <span class="badge bg-warning">PENDING</span>
                           @elseif($item->status == 'SUCCESS')
                               <span class="badge bg-success">SUCCESS</span>
                           @else
                               <span class="badge bg-danger">CANCELLED</span>
                           @endif
                       </td>
                       <td>Rp{{ number_format($item->total_harga) }}</td>
                       <td>

                        @if ($item->status == 'SUCCESS')
                        <a href="{{ route('admin.transaksi.update.status.check.in.out', $item->id) }}"
                            onclick="return confirm('Yakin ?')"
                            class="btn btn-success btn-sm">Check In</a>
                        <a href="{{ route('admin.transaksi.update.cancel', $item->id) }}"
                            onclick="return confirm('Yakin ?')"
                            class="btn btn-danger btn-sm">Cancel</a>
                        @elseif($item->status == 'CHECK IN')
                        <a href="{{ route('admin.transaksi.update.status.check.in.out', $item->id) }}"
                            onclick="return confirm('Yakin ?')"
                            class="btn btn-danger btn-sm">Check Out</a>
                        @endif
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


  @push('down-style')
  <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/fontawesome.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/datatables.css" />
  @endpush
  @push('down-script')
    <script src="{{ asset('assets') }}/js/extensions/datatables.js"></script>

  @endpush

@endsection
