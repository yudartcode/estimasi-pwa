@extends('back.layouts.master')

@section('title_menu')
    Pemesanan
@endsection

@section('title')
    Data Pemesanan
@endsection

@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
    <style>
        label.error {
            color: #F94687;
            font-size: 13px;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.5;
            margin-top: 5px;
            padding: 0;
        }

        input.error {
            color: #F94687;
            border: 1px solid #F94687;
        }

        textarea.error {
            color: #F94687;
            border: 1px solid #F94687;
        }

        select.error {
            color: #F94687;
            border: 1px solid #F94687;
        }
    </style>
@endsection

@section('content')
    {{-- <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ url()->current() }}">Ukuran</a></li>
        </ol>
    </div>
    <!-- row -->
 --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Pemesanan</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <select class="form-control text-dark" id="pilihStatusPemesanan">
                                <option value="semua">
                                    PILIH STATUS PEMESANAN
                                </option>
                                <option value="diterima">
                                    DITERIMA
                                </option>
                                <option value="ditolak">
                                    DITOLAK
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="wrap">
                    {{-- <div class="table-responsive"> --}}
                    <table id="data_pesanan_table" class="table dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pemesan</th>
                                <th>Tipe Estimasi</th>
                                <th>Jenis Kain</th>
                                {{-- <th>Jenis Kemeja</th> --}}
                                <th>Ukuran</th>
                                <th>Lengan</th>
                                <th>Total Biaya</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php
                                $increment = 1;
                            @endphp

                            @foreach ($pemesanan as $data)
                                <tr>
                                    <td>{{ $increment++ }} </td>
                                    <td>{{ $data->user->nama }}</td>
                                    <td>{{ $data->tipe_estimasi == '1' ? 'Menggunakan Kain Yang Tersedia' : 'Menggunakan Kain Yang Dibawa Sendiri' }}
                                    </td>
                                    <td>{{ $data->kain->nama }}</td>
                                    {{-- <td>{{ $data->kemeja->nama }}</td> --}}
                                    <td>{{ $data->ukuran->nama }}</td>
                                    <td>{{ $data->lengan->nama }}</td>
                                    <td>{{ $data->total_biaya }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>
                                        <div class="form-group">
                                            <form action="{{ route('aksi.status') }}" id="formTerima" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <input type="hidden" name="status" value="diterima">
                                                <button type="submit" style="width: 100%;""
                                                    class="btn btn-xs text-white btn-success"
                                                    id="terimaButton">Terima</button>
                                            </form>
                                            <form action="{{ route('aksi.status') }}" id="formTolak" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <input type="hidden" name="status" value="ditolak">
                                                <button type="submit" style="width: 100%;"
                                                    class="btn btn-xs text-white btn-danger" id="tolakButton">Tolak</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/deznav-init.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <!-- CONVERT NUMBER TO RUPIAH CURRENCY -->
    <script src="https://unpkg.com/@develoka/angka-terbilang-js/index.min.js"></script>

    <!-- Datatable -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#data_pesanan_table').DataTable();
    </script>

    <script>
        $("#terimaButton").click(function(e) {
            var id = $("input[name=id]").val();
            var status = $("input[name=status]").val();
            $.ajax({
                url: "{{ route('aksi.status') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    status: status,
                },
                success: function(data) {
                    if (data.status == "berhasil") console.log("berhasil");
                }
            });
        });

        $("#formTerima").validate({
            rules: {
                id: {
                    required: true,
                },
                status: {
                    required: true,
                },
            },
            messages: {
                id: {
                    required: "id harus di isi",
                },
                status: {
                    required: "status harus di isi",
                },
            },
            submitHandler: function(form) {
                $("#terimaButton").prop('disabled', true);
                form.submit();
            }
        });


        // $("#tolakButton").click(function(e) {
        //     var id = $("input[name=id]").val();
        //     var status = $("input[name=status]").val();
        //     $.ajax({
        //         url: "{{ route('aksi.status') }}",
        //         method: "POST",
        //         data: {
        //             "_token": "{{ csrf_token() }}",
        //             id: id,
        //             status: status,
        //         },
        //         success: function(data) {
        //             if (data.status == "berhasil") console.log("berhasil");
        //         }
        //     });
        // });

        // $("#formTolak").validate({
        //     rules: {
        //         id: {
        //             required: true,
        //         },
        //         status: {
        //             required: true,
        //         },
        //     },
        //     messages: {
        //         id: {
        //             required: "id harus di isi",
        //         },
        //         status: {
        //             required: "status harus di isi",
        //         },
        //     },
        //     submitHandler: function(form) {
        //         $("#tolakButton").prop('disabled', true);
        //         form.submit();
        //     }
        // });
    </script>

    <script>
        $("#pilihStatusPemesanan").change(function() {
            var status = $("#pilihStatusPemesanan").val();

            $.ajax({
                url: "{{ route('estimasi.select') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    status: status
                },
                success: function(data) {
                    $('#wrap').html(data);
                    $('#data_pesanan_table').DataTable();
                }
            });
        });
    </script>
@endsection
