@extends('front.layouts.master')


@section('title_menu')
    Portpolio
@endsection

@section('title')
    Data Portpolio
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('front/css/product.css') }}" />
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
                <h1 class="page_header" style="color: #ffffff;">Detail Portpolio</h1>
                <p class="page_text" style="color: #ffffff;">___________________________________</p>
            </div>
        </div>
        <div class="container">
            <ul class="page_breadcrumbs d-flex flex-wrap">
                <li class="page_breadcrumbs-item">
                    <a class="link" href="{{ url('/portpolio-front') }}">Portpolio</a>
                </li>

                <li class="page_breadcrumbs-item current">
                    <span>{{ $portpolio->nama }}</span>
                </li>
            </ul>
        </div>
    </header>
    <section class="about section--nopb">
        <div class="container">
            <!-- Product main -->
            <div class="about_main d-lg-flex flex-nowrap">
                <div class="about_main-slider">
                    <div class="about_main-slider--single" data-modal="false">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="{{ asset('foto_portpolio/' . $portpolio->foto) }}" data-role="gallery">
                                    <picture>
                                        <source data-srcset="{{ asset('foto_portpolio/' . $portpolio->foto) }}"
                                            srcset="{{ asset('foto_portpolio/' . $portpolio->foto) }}" type="image/webp" />
                                        <img class="lazy" data-src="{{ asset('foto_portpolio/' . $portpolio->foto) }}"
                                            src="{{ asset('foto_portpolio/' . $portpolio->foto) }}" alt="media" />
                                    </picture>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about_main-info">
                    <div class="about_main-info_product d-sm-flex align-items-center justify-content-between">
                        <h2 class="title">{{ $portpolio->nama }}</h2>
                    </div>
                    <ul>
                        <li> Jenis : {{ $portpolio->jenis }} </li>
                        <li> Bahan : {{ $portpolio->bahan }} </li>
                        <li> Lengan : {{ $portpolio->lengan }} </li>
                    </ul>
                    <p class="about_main-info_description">
                    </p>
                    <br>
                    <div class="qty_plus"></div>
                    <div class="qty_minus"></div>

                    <span class="about_main-info_price">RP.
                        {{ number_format((float) $portpolio->biaya, 0, ',', '.') }} </span>
                    <div class="about_main-info_buy d-flex align-items-center">
                        {{-- <form action="#" method="post">
                            @if (Auth::guard('web')->user())
                                <input type="hidden" name="paket_wedding_id" value="{{ $portpolio->id }}">
                                <input type="hidden" name="user_id"
                                    value="{{ isset(Auth::guard('web')->user()->id) ? Auth::guard('web')->user()->id : '' }}">
                                @php
                                    $check = \App\Models\Pemesanan::where('user_id', Auth::guard('web')->user()->id)->count();
                                @endphp
                                @if ($check >= 1)
                                    <div style="display: flex; justify-conten: center;">
                                        <a href="{{ route('pemesanan-wa', Auth::guard('web')->user()->id) }}"
                                            class="btn" style="font-size: 15px;margin-top: 20px !important;">Tambah Ke
                                            Keranjang</a>
                                    </div>
                                @else
                                    <button type="button" class="btn" id="keranjangButton">Tambah Ke Keranjang</button>
                                @endif
                            @else
                                <a data-bs-toggle="offcanvas" data-bs-target="#loginCanvas" class="btn">Tambah Ke
                                    Keranjang</a>
                            @endif
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('front/js/shop.min.js') }}"></script>
@endsection
