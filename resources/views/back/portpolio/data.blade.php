@extends('back.layouts.master')

@section('title_menu')
    Portpolio
@endsection

@section('title')
    Data Portpolio
@endsection

@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
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

        .dropzone {
            border: 1px solid #e6e6e6 !important;
            border-radius: 4px;
            color: #c8c8c9 !important;
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
            <li class="breadcrumb-item active"><a href="{{ url()->current() }}">Portpolio</a></li>
        </ol>
    </div>
    <!-- row -->
 --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" data-toggle="modal" data-target="#addPortpolioModal"
                        class="btn btn-primary btn-sm" data-animation="slide" data-plugin="custommodal"
                        data-overlaySpeed="200" data-overlayColor="#36404a"><i class="fa fa-plus-circle mr-1"></i>
                        Tambah</button>
                </div>
                <div class="card-body" id="wrap">
                    {{-- <div class="table-responsive"> --}}
                    <table id="portpolio_table" class="table dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Bahan</th>
                                <th>Lengan</th>
                                <th>Biaya</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php
                                $increment = 1;
                            @endphp

                            @foreach ($portpolio as $data)
                                <tr>
                                    <td>{{ $increment++ }} </td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->jenis }}</td>
                                    <td>{{ $data->bahan }}</td>
                                    <td>{{ $data->lengan }}</td>
                                    <td>Rp.{{ number_format((float) $data->biaya, 0, ',', '.') }}</td>
                                    <td>
                                        <img src="{{ asset('foto_portpolio/' . $data->foto) }}" style="width: 100px">
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <button type="button" data-toggle="modal" data-target="#editPortpolioModal"
                                                style="width: 100%;" onclick="editPortpolioFunction({{ $data }})"
                                                class="btn btn-warning btn-xs text-white"><i class="fa fa-edit mr-1"></i>
                                                Edit</button>
                                            <form action="{{ route('portpolio.destroy', $data->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="deletePortpolioFunction(this)"
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

    <div class="modal fade" id="addPortpolioModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Portpolio</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('portpolio.store') }}" method="post" id="addPortpolioForm"
                        class="add-portpolio-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" required>
                        </div>

                        <div class="form-group">
                            <label for="jenis">Jenis <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis" aria-label="jenis" required>
                                <option value="">Pilih</option>
                                @foreach ($kemeja as $item)
                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="bahan">Bahan <span class="text-danger">*</span></label>
                            <select class="form-control" name="bahan" aria-label="bahan" required>
                                <option value="">Pilih</option>
                                @foreach ($kain as $item)
                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="lengan">Lengan <span class="text-danger">*</span></label>
                            <select class="form-control" name="lengan" aria-label="lengan" required>
                                <option value="">Pilih</option>
                                @foreach ($lengan as $item)
                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="biaya">Biaya <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="biaya"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                placeholder="Masukan Biaya" required>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Kemeja <span class="text-danger">*</span></label>
                            <input type="file" name="foto" id="foto" accept="images/jpg" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary" id="addPortpolioButton">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPortpolioModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Portpolio</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('portpolio.update', '') }}" method="post" id="editPortpolioForm"
                        class="edit-portpolio-form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="_id">
                        {{-- <input type="hidden" id="get_portpolio_id" class="get-portpolio-id" name="get_portpolio_id"> --}}

                        <div class="form-group">
                            <label for="edit_nama">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="edit_nama" placeholder="Masukan Nama"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="edit_jenis">Jenis <span class="text-danger">*</span></label>
                            <select class="form-control" name="edit_jenis" aria-label="edit_jenis" required>
                                <option value="">Pilih</option>
                                @foreach ($kemeja as $item)
                                    <option value="{{ $item->jenis }}">{{ $item->jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_bahan">Bahan <span class="text-danger">*</span></label>
                            <select class="form-control" name="edit_bahan" aria-label="edit_bahan" required>
                                <option value="">Pilih</option>
                                @foreach ($kain as $item)
                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_lengan">Lengan <span class="text-danger">*</span></label>
                            <select class="form-control" name="edit_lengan" aria-label="edit_lengan" required>
                                <option value="">Pilih</option>
                                @foreach ($lengan as $item)
                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_biaya">Biaya <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="edit_biaya" placeholder="Masukan Biaya">
                        </div>

                        {{-- <div class="form-group">
                            <label for="edit_foto">Foto Kemeja <span class="text-danger">*</span></label>
                            <input type="file" name="edit_foto" id="edit_foto" accept="images/jpg">
                        </div> --}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary edit-portpolio-button"
                        id="editPortpolioButton">Simpan
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

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
        $('#portpolio_table').DataTable();
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
        // Portpolio 
        const updatePortpolioLink = $('.edit-portpolio-form').attr('action');
        const idPortpolioForm = $('.edit-portpolio-form').attr('id');
        const id = $('.get-portpolio-id').attr('id');
        const editPortpolioButton = $('.edit-portpolio-button').attr('id');

        function editPortpolioFunction(data) {

            // make form id unique for jquery validaiton
            $('.edit-portpolio-form').attr('id', `${idPortpolioForm}${data.id}`);
            // $('#get_portpolio_id').attr('id', `${id}${data.id}`);

            $('.edit-portpolio-button').attr('id', `${editPortpolioButton}${data.id}`);
            $('.edit-portpolio-form').attr('action', `${updatePortpolioLink}/${data.id}`);

            $('[name="_id"]').val(data.id);
            // $('[name="get_portpolio_id"]').val(data.id);
            $('[name="edit_nama"]').val(data.nama);
            $('[name="edit_jenis"]').val(data.jenis);
            $('[name="edit_bahan"]').val(data.bahan);
            $('[name="edit_lengan"]').val(data.lengan);
            $('[name="edit_biaya"]').val(data.biaya);

            // $('[name="edit_foto"]').val(data.foto);
            $('input[name="_id"]').val()
            validateEdit(data.id);
        }
    </script>

    <script>
        function deletePortpolioFunction(e) {
            Swal.fire({
                title: "Hapus data  portpolio?",
                text: `Data  portpolio akan terhapus. Anda tidak akan dapat mengembalikan
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
