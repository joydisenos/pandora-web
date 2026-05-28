@extends('layouts.principal')

@section('header')
@endsection

@section('content')

<main class="bg_gray">
    <div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
        <img class="jarallax-img" src="{{ asset('assets/img/actualidad_riviera_blog.webp') }}" alt="">
        <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
            <div class="container">
                <small class="slide-animated one">Pandora</small>
                <h1 class="slide-animated two">Favoritos</h1>
            </div>
        </div>
    </div>
    <!-- /Background Img Parallax -->

    @livewire('wishlist-component')
</main>

@endsection

@section('scripts')
@endsection
