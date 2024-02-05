@extends('front.layouts.master')

@section('title_menu')
    Welcome
@endsection

@section('title')
    Welcome
@endsection

@section('css')
@endsection

@section('content')
    <!-- Hero section start -->
    <section class="hero">
        <div class="container d-xl-flex align-items-start">
            <div class="hero_about col-xl-6">
                <div class="hero_header">
                    <h2 class="hero_header-title" style="color: #440A67;">
                        Mari estimasikan budget untuk kemeja anda Dengan Risky Tailor
                    </h2>
                    <p class="hero_header-text" style="color: black">

                    </p>
                </div>
            </div>
            <div class="hero_promo col-xl-6">
                <div>
                    <picture>
                        <source data-srcset="{{ asset('home-background-1.jpg') }}"
                            srcset="{{ asset('home-background-1.jpg') }}" type="image/webp" />
                        <img class="lazy" style="border-radius:7px;" data-src="{{ asset('home-background-1.jpg') }}"
                            src="{{ asset('home-background-1.jpg') }}" alt="media" />
                    </picture>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram section start -->
    <section class="instagram" style="margin-top: 100px;">
        <div class="container">
            <div class="instagram_header">
                <h2 class="instagram_header-title" style="color: #440A67;">Portpolio</h2>
                <p class="instagram_header-text" style="color:black;">
                    Portpolio dari jasa yang kami sediakan.
                </p>
            </div>
        </div>
        <div class="instagram_slider swiper">
            <div class="swiper-wrapper">
                @foreach ($portpolio as $item)
                    <div class="instagram_slider-slide swiper-slide">
                        <a class="link" href="{{ url('portpolio-front', $item->id) }}" target="_blank"
                            rel="noopener norefferer">
                            <picture>
                                <source data-srcset="{{ asset('foto_portpolio/' . $item->foto) }}"
                                    srcset="{{ asset('foto_portpolio/' . $item->foto) }}" type="image/webp" />
                                <img class="lazy" data-src="{{ asset('foto_portpolio/' . $item->foto) }}"
                                    src="{{ asset('foto_portpolio/' . $item->foto) }}"
                                    style="object-fit: cover;height: 400px;" alt="instagram post" />
                            </picture>
                            <span class="overlay d-flex justify-content-center align-items-center">
                                <ul>
                                    <li>{{ $item->nama }}</li>
                                    <li>{{ $item->jenis }}</li>
                                    <li>{{ $item->bahan }}</li>
                                    <li>{{ $item->biaya }}</li>
                                </ul>
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>
            <a class="featured_btn btn" href="{{ url('portpolio-front') }}">Lihat Portpolio</a>
        </div>
    </section>

    <!-- Hero section end -->
    <!-- Featured products section start -->
    <section class="featured section--nopb">
        <div class="container">
            <div class="featured_header">
                <h2 class="featured_header-title" style="color: #440A67;">Calculate Cost</h2>
                <p class="featured_header-text" style="color: black;">
                    Hitung estimasi anda sekarang.
                </p>
            </div>
        </div>
    </section>
@endsection
