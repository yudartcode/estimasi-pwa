@extends('front.layouts.master')

@section('title_menu')
    Estimation Result
@endsection

@section('title')
    Estimation Result
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
                <h1 class="page_header" style="color: #F4F9F9;">Estimation Result</h1>
                <p class="page_text" style="color: #ffffff;">___________________________________</p>
            </div>
        </div>
        <div class="container">
            <ul class="page_breadcrumbs d-flex flex-wrap">
                <li class="page_breadcrumbs-item">
                    <a class="link" href="{{ url('/calculate') }}">Calculate Cost</a>
                </li>

                <li class="page_breadcrumbs-item current">
                    <span>Estimation Result</span>
                </li>
            </ul>
        </div>
    </header>

    <main>
        <section>
            <div class="about section--nopb">
                <div class="container">
                    <div class="about_main d-lg-flex flex-nowrap">
                        <div class="about_main-slider" style="margin-right: 20px">
                            <div class="about_main-slider--single" data-modal="false">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a href="{{ $portpolio ? asset('foto_portpolio/' . $portpolio->foto) : asset('noimage.jpg') }}"
                                            data-role="gallery">
                                            <picture>
                                                <source
                                                    data-srcset="{{ $portpolio ? asset('foto_portpolio/' . $portpolio->foto) : asset('noimage.jpg') }}"
                                                    srcset="{{ $portpolio ? asset('foto_portpolio/' . $portpolio->foto) : asset('noimage.jpg') }}"
                                                    type="image/webp" />
                                                <img class="lazy"
                                                    data-src="{{ $portpolio ? asset('foto_portpolio/' . $portpolio->foto) : asset('noimage.jpg') }}"
                                                    src="{{ $portpolio ? asset('foto_portpolio/' . $portpolio->foto) : asset('noimage.jpg') }}"
                                                    alt="media" />
                                            </picture>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-borderless">
                            <tr>
                                <th style="text-align: left">Tipe Estimasi</th>
                                <td style="padding: 10px">:</td>
                                <td>{{ $tipe }}
                                </td>
                            </tr>
                            <tr>
                                <th style="text-align: left">Jenis Kain</th>
                                <td style="padding: 10px">:</td>
                                <td>{{ $kain }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left">Jenis Kemeja</th>
                                <td style="padding: 10px">:</td>
                                <td>{{ $kemeja }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left">Lengan</th>
                                <td style="padding: 10px">:</td>
                                <td>{{ $lengan }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left">Ukuran</th>
                                <td style="padding: 10px">:</td>
                                <td>{{ $ukuran }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left">Estimasi Panjang Kain</th>
                                <td style="padding: 10px">:</td>
                                <td>{{ $estimasi_kain }} Meter</td>
                            </tr>
                            <tr>
                                <th style="text-align: left">Estimasi Biaya</th>
                                <td style="padding: 10px">:</td>
                                <td>RP. {{ number_format((float) $estimasi_biaya, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="/calculate" class="btn btn-sm btn-secondary" style="margin-right: 10px">Kembali</a>
                        @if (Auth::guard('admin')->user())
                            <form action="{{ route('calculate.simpan') }}" id="formSimpan" method="post">
                                @csrf
                                <input type="hidden" name="tipe" value="{{ $tipe }}">
                                <input type="hidden" name="kain_id" value="{{ $kain_id }}">
                                <input type="hidden" name="kemeja_id" value="{{ $kemeja_id }}">
                                <input type="hidden" name="lengan_id" value="{{ $lengan_id }}">
                                <input type="hidden" name="ukuran_id" value="{{ $ukuran_id }}">
                                <input type="hidden" name="total_meter_kain" value="{{ $estimasi_kain }}">
                                <input type="hidden" name="total_biaya" value="{{ $estimasi_biaya }}">
                                <input type="hidden" name="user_id" value="{{ Auth::guard('admin')->user()->id }}">
                                <button type="submit" id="pesan" class="btn btn-sm btn-primary">Pesan
                                    Sekarang</button>
                            </form>
                        @endif
                    </div>
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
        $("#pesan").click(function(e) {
            var tipe = $("input[name=tipe]").val();
            var kain_id = $("input[name=kain_id]").val();
            var kemeja_id = $("input[name=kemeja_id]").val();
            var lengan_id = $("input[name=lengan_id]").val();
            var ukuran_id = $("input[name=ukuran_id]").val();
            var total_meter_kain = $("input[name=total_meter_kain]").val();
            var total_biaya = $("input[name=total_biaya]").val();
            var user_id = $("input[name=user_id]").val();

            $.ajax({
                url: "{{ route('calculate.simpan') }}",
                method: "POST",
                data: {
                    tipe: tipe,
                    kain_id: kain_id,
                    kemeja_id: kemeja_id,
                    lengan_id: lengan_id,
                    ukuran_id: ukuran_id,
                    total_meter_kain: total_meter_kain,
                    total_biaya: total_biaya,
                    user_id: user_id,
                },
                success: function(data) {
                    if (data.status == "berhasil") console.log("berhasil");
                }
            });
        })

        $("#formSimpan").validate({
            submitHandler: function(form) {
                $("#simpan").prop('disabled', true);
                form.submit();
            }
        });
    </script>
@endsection
