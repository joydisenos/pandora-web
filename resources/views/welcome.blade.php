@extends('layouts.principal')
@section('header')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

@endsection
@section('content')
<div class="slider-hero">
    @foreach(SliderPrincipal() as $slider)
        <div class="hero home-search full-height jarallax"
                style="background-image: url('{{ $slider->imagen() }}');background-size: cover;">
                <div class="wrapper opacity-mask d-flex align-items-center justify-content-center animate_hero"
                    data-opacity-mask="rgba(0, 0, 0, 0.2)">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <small class="slide-animated one">Luxury Hotel Experience</small> -->
                                <h3 class="slide-animated two text-center text-beige">{{ $slider->nombre }}</h3>
                                <h4 class="text-center text-beige mb-4">{{ $slider->descripcion }}
                                </h4>
                                <div class="text-center">
                                    <a href="{{ $slider->link }}" class="btn_1">{{ $slider->boton_texto }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mouse_wp slide-animated four">
                        <a href="#first_section" class="btn_scrollto">
                            <div class="mouse"></div>
                        </a>
                    </div>
                    <!-- /mouse_wp -->
                </div>
        </div>
    @endforeach
</div>

        <!-- /Pattern  -->
            <div class="container margin_120_95" id="first_section">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12">
                        <div class="descripcion-nosotros">
                            <div class="title text-center">
                                <h3 class="titulo-nosotros mb-4">Productos</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            @foreach(categoriasPublicas(4) as $categoria)
                                <div class="col-md-3 position-relative">
                                    <img src="{{ $categoria->imagen() }}" alt="" class="img-aliado mb-4">
                                    <div class="position-absolute bottom-0 left-0 w-100 h-full d-flex align-items-center justify-content-center text-center mb-4">
                                        
                                            <a href="{{ route('tienda' , ['categoriaId' => $categoria->id]) }}" class="btn_1 mb-4">
                                                {{ $categoria->nombre }}
                                            </a>
                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
                <!-- /Row -->
            </div>
        <!-- /container-->

        
        <!-- /Pattern  -->
            <div class="container margin_120_95" id="second_section">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12">
                        <div class="d-flex flex-column flex-lg-row">
                            <div style="background-color: #f1eee9; padding:50px" class="w-100 w-md-50">
                                <p>Nuestra Historia</p>
                                <h2>¿Quiénes somos?</h2>
                                <img src="{{ asset('assets/img/logo_pandora.png') }}" class="img-fluid" alt="">
                                <p><strong>PANDORA HOTEL COLLECTION</strong> es una empresa líder en la <strong>producción</strong>, <strong>importación</strong> y <strong>distribución</strong> de textiles de alta calidad para la industria hotelera y del hogar. Con una amplia gama de productos que incluyen almohadas, protectores, sábanas, fundas, edredones, toallas y frazadas, nos especializamos en ofrecer soluciones personalizadas.</p>
                                <a href="{{ route('nosotros') }}" class="btn_1 bg-blue-pri">Leer más</a>
                            </div>
                            <img src="{{ asset('assets/img/nosotros.jpg') }}" alt="" class="w-100">
                        </div>
                    </div>
                    
                </div>
                <!-- /Row -->
            </div>
        <!-- /container-->

        <!-- /Pattern  -->
            <div class="container margin_120_95" id="third_section">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12">
                        <div class="descripcion-nosotros">
                            <div class="title text-center">
                                <small>Lo más vendido.</small>
                                <h3 class="titulo-nosotros mb-4">Productos en Tendencia</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            @foreach(productosMasVendidos(4) as $producto)
                                <div class="col-md-3 mb-4">
                                    @include('includes.producto', ['producto' => $producto])
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
                <!-- /Row -->
            </div>
        <!-- /container-->


   
        <!-- /Pattern  -->
         <section class="d-flex align-items-center" style="background: url({{ asset('assets/img/banner-2.jpg') }}) no-repeat center center; background-size: cover; background-attachment: fixed; min-height: 500px; overflow: hidden; position:relative">
            <div class="cover-pantalla" style="z-index: 1;"></div>
            <div class="container margin_120_95" id="fourth_section" >
                <div class="row justify-content-between align-items-center position-relative" style="z-index: 10;">
                    <div class="col-12 text-center text-white">
                        <h5 class="text-white">Almohadas</h5>
                        <h1 class="text-white">¡Conoce nuestras Almohadas para el descanso!</h1>
                        <a href="{{ route('tienda' , ['categoriaId' => 1]) }}" class="btn_1 bg-blue-pri">Ver Almohadas</a>
                    </div>
                    
                </div>
                <!-- /Row -->
            </div>
            <!-- /container-->
         </section>    

        <!-- /Pattern  -->
            <div class="container margin_120_95" id="fifth_section">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12">
                        <div class="descripcion-nosotros">
                            <div class="title text-center">
                                <small>Nuestro Blog</small>
                                <h3 class="titulo-nosotros mb-4">Consejos, notas tip's y mucho más</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            @foreach(postsPublicos(3) as $post)
                                <div class="col-md-4 mb-4">
                                    <a href="{{ route('blog.detalle' , $post->slug) }}">
                                        <img src="{{ $post->imagen() }}" alt="" class="img-aliado mb-4">
                                    </a>
                                    <a href="{{ route('blog.detalle' , $post->slug) }}">
                                        <h4 class="text-beige mb-2">{{ Str::limit($post->nombre , 80) }}</h4>
                                    </a>
                                    <p class="text-beige">{{ Str::limit(strip_tags($post->contenido) , 500) }}</p>
                                    <a href="{{ route('blog.detalle' , $post->slug) }}" class="btn_1">Leer más</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
                <!-- /Row -->
            </div>
        <!-- /container-->
       
       
        
        


@endsection
@section('scripts')
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
$('.slider-hero').slick({
    arrows: false
})
</script>
@endsection