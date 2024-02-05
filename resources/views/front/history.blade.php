@extends('front.layouts.master')

@section('title_menu')
    Estimation History
@endsection

@section('title')
    Estimation History
@endsection

@section('css')
    <link rel="stylesheet preload" as="style" href="{{ asset('css/bootstrap.css') }}" />
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
                <h1 class="page_header" style="color: #F4F9F9;">Estimation History</h1>
                <p class="page_text" style="color: #ffffff;">___________________________________</p>
            </div>
        </div>
        <div class="container">
            <ul class="page_breadcrumbs d-flex flex-wrap">
                <li class="page_breadcrumbs-item">
                    <a class="link" href="{{ url('/calculate') }}">Calculate Cost</a>
                </li>

                <li class="page_breadcrumbs-item current">
                    <span>Estimation History</span>
                </li>
            </ul>
        </div>
    </header>

    <main>
        <section>
            <div class="about section--nopb">
                <div class="container">
                    <div class="d-flex justify-content-center">
                        <table id="history_table" class="table table-bordered">
                            <thead>
                                <th>Tipe Estimasi</th>
                                <th>Jenis Kain</th>
                                <th>Jenis Kemeja</th>
                                <th>Lengan</th>
                                <th>Ukuran</th>
                                <th>Panjang Kain</th>
                                <th>Biaya</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach ($history as $data)
                                    <tr>
                                        <td>{{ $data->tipe_estimasi == '1' ? 'Menggunakan Kain Yang Tersedia' : 'Menggunakan Kain Yang Dibawa Sendiri' }}
                                        </td>
                                        <td>{{ $data->kain->nama }}</td>
                                        <td>{{ $data->kemeja->nama }}</td>
                                        <td>{{ $data->lengan->nama }}</td>
                                        <td>{{ $data->ukuran->nama }}</td>
                                        <td>{{ $data->total_meter_kain }}</td>
                                        <td>{{ $data->total_biaya }}</td>
                                        <td>{{ $data->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="top section">

    </section>
@endsection

@section('js')
    <!-- Datatable -->
    <script src="{{ asset('front/js/shop.min.js') }}"></script>
@endsection
