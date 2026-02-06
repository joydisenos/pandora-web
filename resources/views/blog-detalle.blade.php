@extends('layouts.principal')
@section('header')  
    <link rel="stylesheet" href="{{ asset('assets/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/special-classes.css')}}">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.css" />
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

<!-- Single Blog -->
<section class="singleblog-section blogpage-section w-100 float-left">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="main-box">
                    <figure class="image1" data-aos="fade-up" data-aos-duration="700">
                        <img src="{{ $post->imagen() }}" alt="" class="img-fluid">
                    </figure>
                    <div class="content1">
                        <h4 data-aos="fade-up" data-aos-duration="700">{{ $post->nombre }}</h4>
                        <i class="fas fa-user" data-aos="fade-up" data-aos-duration="700"></i>
                        <span class="text-size-14 text-mr" data-aos="fade-up" data-aos-duration="700">Autor :
                            {{ $post->autor }}</span>
                        <i class="fas fa-calendar-alt" data-aos="fade-up" data-aos-duration="700"></i>
                        <span class="mb-0 text-size-14" data-aos="fade-up" data-aos-duration="700">{{ $post->created_at->format('M d, Y') }}</span>
                        <p class="text-size-14" data-aos="fade-up" data-aos-duration="700">{!! nl2br($post->descripcion) !!}</p>
                    </div>
                    <div class="ck-content">
                        {!! $post->contenido !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 column">
                <div class="box1">
                    <h5 data-aos="fade-up" data-aos-duration="700">Buscar</h5>
                    <form method="get" action="{{ route('blog') }}">
                        <div class="form-row" data-aos="fade-up" data-aos-duration="700">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input type="text" name="buscar" id="buscar" class="form-control upper_layer"
                                    placeholder="Buscar...">
                                <div class="input-group-append form-button">
                                    <button class="btn search" name="btnsearch" id="searchbtn"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box1 box2">
                    <h5 data-aos="fade-up" data-aos-duration="700">Últimos Posts</h5>
                    <ul class="list-unstyled mb-0">
                        @foreach(postsPublicos(4) as $postRel)
                        <li class="text-size-16" data-aos="fade-up" data-aos-duration="700"><a
                                href="{{ route('blog.detalle' , $postRel->slug) }}">{{ $postRel->nombre }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--blog-sec-->

@endsection
@section('scripts')
@endsection