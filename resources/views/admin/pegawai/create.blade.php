@extends('layouts.admin')

@section('title', 'Halaman Data Pegawai')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Pegawai</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Form Create Data Pegawai
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">

                <div class="card-header">Form Tambah Pegawai</div>
                <div class="card-body">
                    <form action="{{ route('admin.pegawai.store') }}" id="form" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="event" value="create">
                        @csrf
                        @include('admin.pegawai.form')
                    </form>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>


    @push('down-style')
        <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/fontawesome.css" />
    @endpush
    @push('down-script')
        <script>
            $(document).ready(function() {
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
                $("#form").validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 3,
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        password: {
                            required: true,
                            minlength: 6,
                        },
                        golongan_id: {
                            required: true,
                            digits: true,
                        },
                    }


                });
            });
        </script>
    @endpush

@endsection