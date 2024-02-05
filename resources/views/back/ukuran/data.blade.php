@extends('back.layouts.master')

@section('title_menu')
    Ukuran
@endsection

@section('title')
    Data Ukuran
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
                    <button type="button" data-toggle="modal" data-target="#addUkuranModal" class="btn btn-primary btn-sm"
                        data-animation="slide" data-plugin="custommodal" data-overlaySpeed="200"
                        data-overlayColor="#36404a"><i class="fa fa-plus-circle mr-1"></i>
                        Tambah</button>
                </div>
                <div class="card-body" id="wrap">
                    {{-- <div class="table-responsive"> --}}
                    <table id="ukuran_table" class="table dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Meter Kain</th>
                                <th>Biaya</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php
                                $increment = 1;
                            @endphp

                            @foreach ($ukuran as $data)
                                <tr>
                                    <td>{{ $increment++ }} </td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->meter_kain }}</td>
                                    <td>{{ $data->biaya }}</td>
                                    <td>
                                        <div class="form-group">
                                            <button type="button" data-toggle="modal" data-target="#editUkuranModal"
                                                style="width: 100%;" onclick="editUkuranFunction({{ $data }})"
                                                class="btn btn-warning btn-xs text-white"><i class="fa fa-edit mr-1"></i>
                                                Edit</button>
                                            <form action="{{ route('ukuran.destroy', $data->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="deleteUkuranFunction(this)"
                                                    style="width: 100%;" class="btn btn-xs text-white btn-danger"
                                                    id="deleteButton"><i class="fa fa-trash mr-1"></i> Hapus</button>
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

    <div class="modal fade" id="addUkuranModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Ukuran</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ukuran.store') }}" method="post" id="addUkuranForm" class="add-ukuran-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" required>
                        </div>

                        <div class="form-group">
                            <label for="meter_kain">Meter Kain <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="meter_kain" placeholder="Masukan Meter Kain"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="biaya">Biaya <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="biaya"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                placeholder="Masukan Biaya" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary" id="addUkuranButton">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUkuranModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Ukuran</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ukuran.update', '') }}" method="post" id="editUkuranForm"
                        class="edit-ukuran-form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="_id">
                        {{-- <input type="hidden" id="get_ukuran_id" class="get-ukuran-id" name="get_ukuran_id"> --}}

                        <div class="form-group">
                            <label for="edit_nama">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="edit_nama" placeholder="Masukan Nama">
                        </div>

                        <div class="form-group">
                            <label for="edit_meter_kain">Meter Kain <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="edit_meter_kain"
                                placeholder="Masukan Meter Kain">
                        </div>

                        <div class="form-group">
                            <label for="edit_biaya">Biaya <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="edit_biaya" placeholder="Masukan Biaya">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary edit-ukuran-button" id="editUkuranButton">Simpan
                        Perubahan</button>
                </div>
                </form>
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
        $('#ukuran_table').DataTable();
    </script>

    <script>
        (function($) {
            $.fn.simpleMoneyFormat = function() {
                this.each(function(index, el) {
                    var elType = null; // input or other
                    var value = null;
                    // get value
                    if ($(el).is('input') || $(el).is('textarea')) {
                        value = $(el).val().replace(/\./g, '');
                        elType = 'input';
                    } else {
                        value = $(el).text().replace(/\./g, '');
                        elType = 'other';
                    }
                    // if value changes
                    $(el).on('paste keyup', function() {
                        value = $(el).val().replace(/\./g, '');
                        formatElement(el, elType, value); // format element
                    });
                    formatElement(el, elType, value); // format element
                });

                function formatElement(el, elType, value) {
                    var result = '';
                    var valueArray = value.split('');
                    var resultArray = [];
                    var counter = 0;
                    var temp = '';
                    for (var i = valueArray.length - 1; i >= 0; i--) {
                        temp += valueArray[i];
                        if (valueArray[i] != ',') {
                            counter++
                        } else if (counter == 1) {
                            counter = counter - 1;
                        } else if (counter == 2) {
                            counter = counter - 2;
                        } else if (counter == 3) {
                            counter = counter - 3;
                        }

                        if (counter == 3) {
                            resultArray.push(temp);
                            counter = 0;
                            temp = '';
                        }
                    };
                    if (counter > 0) {
                        resultArray.push(temp);
                    }
                    for (var i = resultArray.length - 1; i >= 0; i--) {
                        var resTemp = resultArray[i].split('');
                        for (var j = resTemp.length - 1; j >= 0; j--) {
                            result += resTemp[j];
                        };
                        if (i > 0) {
                            result += '.'
                        }
                    };
                    if (elType == 'input') {
                        $(el).val(result);
                    } else {
                        $(el).empty().text(result);
                    }
                }
            };
        }(jQuery));

        $('.money').simpleMoneyFormat();
    </script>
    <script>
        // Ukuran 
        const updateUkuranLink = $('.edit-ukuran-form').attr('action');
        const idUkuranForm = $('.edit-ukuran-form').attr('id');
        const id = $('.get-ukuran-id').attr('id');
        const editUkuranButton = $('.edit-ukuran-button').attr('id');

        function editUkuranFunction(data) {

            // make form id unique for jquery validaiton
            $('.edit-ukuran-form').attr('id', `${idUkuranForm}${data.id}`);
            // $('#get_ukuran_id').attr('id', `${id}${data.id}`);

            $('.edit-ukuran-button').attr('id', `${editUkuranButton}${data.id}`);
            $('.edit-ukuran-form').attr('action', `${updateUkuranLink}/${data.id}`);

            $('[name="_id"]').val(data.id);
            // $('[name="get_ukuran_id"]').val(data.id);
            $('[name="edit_nama"]').val(data.nama);
            $('[name="edit_meter_kain"]').val(data.meter_kain);
            $('[name="edit_biaya"]').val(data.biaya);

            $('[name="edit_foto_"]').val(data.foto_); +
            $('input[name="_id"]').val()
            validateEdit(data.id);
        }
    </script>

    <script>
        function deleteUkuranFunction(e) {
            Swal.fire({
                title: "Hapus data  ukuran?",
                text: `Data  ukuran akan terhapus. Anda tidak akan dapat mengembalikan
                aksi ini!`,
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "rgb(11, 42, 151)",
                cancelButtonColor: "rgb(209, 207, 207)",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then(function(t) {
                if (t.value) {
                    e.parentNode.submit()
                }
            })
        }
    </script>
@endsection
