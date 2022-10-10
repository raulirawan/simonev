@extends('layouts.admin')

@section('title', 'Halaman Data Golongan')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Golongan</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Data Golongan
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">

                <div class="card-header">Tabel Golongan</div>
                <div class="card-body">
                    <a href="{{ route('admin.golongan.create') }}" class="btn btn-success mb-3">
                        Tambah Golongan
                    </a>

                    <!--Basic Modal -->

                    <div class="table-responsive">
                        <table class="table table-striped w-100" id="table-data">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama Golongan</th>
                                    <th>Nama Sub Bagian</th>
                                    <th style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_wisata }}</td>
                                        <td>
                                            <a href="{{ route('golongan.edit', $item->id) }}"
                                                class="btn btn-info btn-sm">Edit</a>
                                            <a href="{{ route('golongan.delete', $item->id) }}"
                                                onclick="return confirm('Yakin ?')" class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach --}}

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
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    @endpush
    @push('down-script')
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function() {

                var datatable = $('#table-data').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    responsive: true,
                    ajax: {
                        url: `${window.location.origin}/admin/golongan`,
                        type: 'GET',
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'nama_golongan',
                            name: 'nama_golongan'
                        },
                        {
                            data: 'subBagian',
                            name: 'subBagian'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searcable: false,
                            width: '15%',
                        }
                    ],


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
                                url: `${window.location.origin}/admin/golongan/${id}`,
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
