@extends('layouts.principal')
@section('header')
<link href="{{asset('assets/css/cart.css')}}" rel="stylesheet">
<style>
  @media (max-width: 991px) {
    .container-pri{
      padding-top: 40px !important;
    }  
  }
  @media (min-width: 992px) {
    .container-pri{
      padding-top: 200px !important;
    }  
  }
</style>
@endsection
@section('content')
<div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset('assets/img/actualidad_riviera_blog.webp') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Pandora</small>
            <h1 class="slide-animated two">Carrito</h1>
        </div>
    </div>
</div>
<!-- /Background Img Parallax -->
  @livewire('carrito-component')
@endsection