@extends('front.layouts.master')

@section('title_menu')
    Portpolio
@endsection

@section('title')
    Data Portpolio
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
                <h1 class="page_header" style="color: #F4F9F9;">Portpolio</h1>
                <p class="page_text" style="color: #ffffff;">___________________________________</p>
            </div>
        </div>
        <div class="container">
            <ul class="page_breadcrumbs d-flex flex-wrap">
                <li class="page_breadcrumbs-item">
                    <a class="link" href="{{ url('/') }}">Beranda</a>
                </li>

                <li class="page_breadcrumbs-item current">
                    <span>Portpolio</span>
                </li>
            </ul>
        </div>
    </header>
    <main>
        <!-- Products section start -->
        <div class="shop-wrapper section--nopb">
            <div class="container d-flex flex-lg-row flex-wrap flex-column justify-content-between">
                <div class="shop_products d-flex flex-column">
                    <ul class="shop_products-list d-sm-flex flex-wrap">
                        @foreach ($portpolio as $item)
                            <li class="shop_products-list_item col-sm-6 col-md-4 col-lg-6 col-xl-4" data-order="1">
                                <div class="wrapper d-flex flex-column">
                                    <div class="media">
                                        <div class="overlay d-flex flex-column align-items-center justify-content-center">
                                            <ul class="action d-flex align-items-center justify-content-center">
                                                <li class="list-item">
                                                    <a class="action_link d-flex align-items-center justify-content-center"
                                                        href="{{ url('portpolio-front', $item->id) }}">
                                                        <i class="icon-eye"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <picture>
                                            <source data-srcset="{{ asset('foto_portpolio/' . $item->foto) }}"
                                                srcset="{{ asset('foto_portpolio/' . $item->foto) }}" type="image/webp" />
                                            <img class="lazy" data-src="{{ asset('foto_portpolio/' . $item->foto) }}"
                                                src="{{ asset('foto_portpolio/' . $item->foto) }}" alt="media" />
                                        </picture>
                                        </a>
                                    </div>
                                    <div class="main d-flex flex-column">
                                        <a class="main_title" href="{{ url('portpolio-front', $item->id) }}"
                                            target="_blank">{{ $item->nama }}</a>
                                        <div class="main_price">
                                            <span
                                                class="price">RP.{{ number_format((float) $item->biaya, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </main>

    <!-- Top products section start -->
    <section class="top section">

    </section>
    <!-- Top products section end -->
@endsection

@section('js')
    <script src="{{ asset('front/js/shop.min.js') }}"></script>
@endsection
