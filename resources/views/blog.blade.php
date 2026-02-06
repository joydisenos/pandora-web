@extends('layouts.principal')
@section('header')  
    <link rel="stylesheet" href="{{ asset('assets/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/special-classes.css')}}">
@endsection
@section('content')
  <!-- BANNER SECTION -->
  <section class="w-100 float-left sub-banner-con position-relative">
    <div class="wrapper2">
        <div class="sub-banner-inner-box banner-inner-box position-relative text-center w-100 float-left">
            <h1 data-aos="fade-up" data-aos-duration="700">Blog</h1>
            <p data-aos="fade-up" data-aos-duration="700">{!! nl2br(opcionSlug('descripcion_blog')) !!}</p>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-duration="700">
                <ol class="breadcrumb d-inline-block mb-0">
                    <li class="breadcrumb-item d-inline-block"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active text-white d-inline-block" aria-current="page">Blog</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- BANNER SECTION -->

@livewire('blog-component')
@endsection
@section('scripts')
@endsection