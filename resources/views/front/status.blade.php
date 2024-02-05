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
                <h1 class="page_header" style="color: #F4F9F9;">Estimation Status</h1>
                <p class="page_text" style="color: #ffffff;">___________________________________</p>
            </div>
        </div>
        <div class="container">
            <ul class="page_breadcrumbs d-flex flex-wrap">
                <li class="page_breadcrumbs-item">
                    <a class="link" href="{{ url('/calculate') }}">Calculate Cost</a>
                </li>

                <li class="page_breadcrumbs-item current">
                    <span>Estimation Status</span>
                </li>
            </ul>
        </div>
    </header>

    <main>
        <section>
            <div class="about section--nopb">
                <div class="container">
                    <div class="d-flex justify-content-center">
                        <table class="table table-borderless">
                            <tr>
                                <th style="text-align: left">Tipe Estimasi</th>
                                <td style="padding: 10px">:</td>
                                <td>{{ $tipe_estimasi == '1' ? 'Menggunakan Kain Yang Tersedia' : 'Menggunakan Kain Yang Dibawa Sendiri' }}
                                </td>
                            </tr>
                            <tr>
                                <th style="text-align: left">Jenis Kain</th>
                                <td style="padding: 10px">:</td>
                                <td>{{ $kain_id }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left">Jenis Kemeja</th>
                                <td style="padding: 10px">:</td>
                                <td>{{ $kemeja_id }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left">Lengan</th>
                                <td style="padding: 10px">:</td>
                                <td>{{ $lengan_id }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left">Ukuran</th>
                                <td style="padding: 10px">:</td>
                                <td>{{ $ukuran_id }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left">Estimasi Panjang Kain</th>
                                <td style="padding: 10px">:</td>
                                <td>{{ $total_meter_kain }} Meter</td>
                            </tr>
                            <tr>
                                <th style="text-align: left">Estimasi Biaya</th>
                                <td style="padding: 10px">:</td>
                                <td>RP. {{ number_format((float) $total_biaya, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <p>Status Pesanan</p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="btn btn-sm btn-primary">{{ $status }}</div>
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
@endsection
