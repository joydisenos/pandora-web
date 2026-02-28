@extends('layouts.principal')
@section('header')  
    <link rel="stylesheet" href="{{ asset('assets/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/special-classes.css')}}">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.css" />
@endsection
@section('content')
  <div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
            <img class="jarallax-img" src="{{ asset('assets/img/actualidad_riviera_blog.webp') }}" alt="">
            <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <small class="slide-animated one">Pandora</small>
                    <h1 class="slide-animated two">{{ $post->nombre }}</h1>
                </div>
            </div>
        </div>
        <!-- /Background Img Parallax -->

<!-- Single Blog -->
<section class="singleblog-section blogpage-section w-100 float-left my-4">
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