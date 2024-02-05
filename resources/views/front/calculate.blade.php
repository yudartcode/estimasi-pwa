@extends('front.layouts.master')

@section('title_menu')
    Estimasi Biaya
@endsection

@section('title')
    Estimasi Biaya
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('front/css/shop.min.css') }}" />

    <style>
        .page_main {
            padding: 60px 0;
            background: #440A67;
            text-align: center;
            margin-bottom: 30px
        }
    </style>
@endsection

@section('content')
    <header class="page" style="margin-top: 140px;">
        <div class="page_main container-fluid">
            <div class="container">
                <h1 class="page_header" style="color: #F4F9F9;">Estimasi Biaya</h1>
                <p class="page_text" style="color: #ffffff;">___________________________________</p>
            </div>
        </div>
        <div class="container">
            <ul class="page_breadcrumbs d-flex flex-wrap">
                <li class="page_breadcrumbs-item">
                    <a class="link" href="{{ url('/') }}">Beranda</a>
                </li>

                <li class="page_breadcrumbs-item current">
                    <span>Estimasi Biaya</span>
                </li>
            </ul>
        </div>
    </header>

    <main>
        <section>
            <div class="shop-wrapper section--nopb">
                <div class="container">
                    <form action="{{ route('calculate.result') }}" id="estimasiForm" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="tipe">Tipe Estimasi <span class="text-danger">*</span></label>
                            <select class="form-control" name="tipe" aria-label="tipe" required>
                                <option value="1">Menggunakan Kain Yang Tersedia</option>
                                <option value="2">Menggunakan Kain Yang Dibawa Sendiri
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="bahan">Bahan <span class="text-danger">*</span></label>
                            <select class="form-control" name="bahan" aria-label="bahan" required>
                                <option value="">Pilih</option>
                                @foreach ($kain as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jenis">Jenis Kemeja <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis" aria-label="jenis" required>
                                <option value="">Pilih</option>
                                @foreach ($kemeja as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="lengan">Lengan <span class="text-danger">*</span></label>
                            <select class="form-control" name="lengan" aria-label="lengan" required>
                                <option value="">Pilih</option>
                                @foreach ($lengan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ukuran">Ukuran <span class="text-danger">*</span></label>
                            <select class="form-control" name="ukuran" aria-label="ukuran" required>
                                <option value="">Pilih</option>
                                @foreach ($ukuran as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary" id="hitung">Hitung Biaya</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <section class="top section">

    </section>
@endsection

@section('js')
    <script src="{{ asset('front/js/shop.min.js') }}"></script>
    <script>
        $("#hitung").click(function(e) {
            var tipe = $("input[name=tipe]").val();
            var bahan = $("input[name=bahan]").val();
            var jenis = $("input[name=jenis]").val();
            var lengan = $("input[name=lengan]").val();
            var ukuran = $("input[name=ukuran]").val();
            $.ajax({
                url: "{{ route('calculate.result') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    tipe: tipe,
                    bahan: bahan,
                    jenis: jenis,
                    lengan: lengan,
                    ukuran: ukuran,
                },
                success: function(data) {
                    if (data.status == "berhasil") console.log("berhasil");
                }
            });
        });

        $("#estimasiForm").validate({
            rules: {
                tipe: {
                    required: true,
                },
                bahan: {
                    required: true,
                },
                jenis: {
                    required: true,
                },
                lengan: {
                    required: true,
                },
                ukuran: {
                    required: true,
                },
            },
            messages: {
                tipe: {
                    required: "Tipe harus di isi",
                },
                bahan: {
                    required: "Bahan harus di isi",
                },
                jenis: {
                    required: "Jenis harus di isi",
                },
                lengan: {
                    required: "Lengan harus di isi"
                },
                ukuran: {
                    required: "Ukuran harus di isi"
                },
            },
            submitHandler: function(form) {
                $("#hitung").prop('disabled', true);
                form.submit();
            }
        });
    </script>
@endsection
