@extends('layouts.principal')
@section('header')
<style>
  .breadcrumbs span , .breadcrumbs span a, .text-black{
    color: #000 !important;
  }
  
  #confirm{
    text-align: center;
    padding: 60px 20px;
    min-height: 70vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

</style>
@endsection
@section('mainClass' , 'bg_gray')
@section('content')
<div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset('assets/img/actualidad_riviera_blog.webp') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Pandora</small>
            <h1 class="slide-animated two">Orden completada</h1>
        </div>
    </div>
</div>
<!-- /Background Img Parallax -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div id="confirm">
                <div>
                    <div class="icon icon--order-success svg add_bottom_15 d-flex justify-content-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                            <g fill="none" stroke="#8EC343" stroke-width="2">
                                <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                            </g>
                        </svg>
                    </div>
                    <h2>Orden completada!</h2>
                    <p>Recibirá un correo con todas las indicaciones necesarias <br> muchas gracias!</p>
                    <a href="{{ route('tienda') }}" class="btn-pri-claro mt-4">Ver más productos</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
</div>
<!-- /container -->
@endsection