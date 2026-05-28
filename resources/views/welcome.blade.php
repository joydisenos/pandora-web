@extends('layouts.principal')
@section('header')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
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
                            <div class="col-md-12 text-center">
                                <div class="d-inline-block w-100 position-relative"
                                    style="max-width: 900px; margin: 0 auto; text-align: left;">
                                    <!-- Crown Icon on the top left -->
                                    <img src="{{ asset('img/corona.png') }}" class="slide-animated one" alt="Crown"
                                        style="width: 80px; margin-bottom: 10px;">

                                    <h3 class="slide-animated two gilda-font text-center"
                                        style="color: #fff; font-size: 55px; text-transform: none !important;">
                                        {{ $slider->nombre }}
                                    </h3>
                                    <h4 class="slide-animated three text-center mb-4 mt-3"
                                        style="color: #fff; font-size: 18px; font-family: 'Quicksand', sans-serif; font-weight: 400;">
                                        {{ $slider->descripcion }}
                                    </h4>
                                    <div class="text-center slide-animated four mt-5">
                                        <a href="{{ $slider->link }}" class="btn_1"
                                            style="background-color: #fff; color: #D48A1F; border: 2px dashed #D48A1F; padding: 12px 30px; font-family: 'Quicksand', sans-serif; font-size: 14px; font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">{{ $slider->boton_texto }}</a>
                                    </div>
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
                <div class="descripcion-nosotros d-none">
                    <div class="title text-center">
                        <h3 class="titulo-nosotros mb-4">Productos</h3>
                    </div>
                </div>
            </div>
            <div class="col-12 px-0">
                <div class="categorias-slider px-4">
                    @foreach(categoriasPublicas(10) as $categoria)
                        <div class="px-2">
                            <div class="d-flex flex-column align-items-center justify-content-center text-center position-relative"
                                style="background: url('{{ $categoria->imagen() }}'); background-position: center center; background-size: cover; height: 450px;">
                                <div
                                    style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.4); z-index: 1;">
                                </div>
                                <h1 class="text-white text-uppercase position-relative"
                                    style="z-index:10; font-family: 'Quicksand', sans-serif; font-weight: 800; font-size: 32px; margin-bottom: 25px; letter-spacing: 1px;">
                                    {{ $categoria->nombre }}
                                </h1>

                                <div class="position-relative" style="z-index:10;">
                                    <a href="{{ route('tienda', ['categoriaId' => $categoria->id]) }}" class="btn_1"
                                        style="background-color: #fff; color: #D48A1F; border: 2px dashed #D48A1F; padding: 8px 30px; font-family: 'Quicksand', sans-serif; font-size: 14px; font-weight: 600; text-transform: uppercase;">
                                        Tienda
                                    </a>
                                </div>
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
                        <p><strong>PANDORA HOTEL COLLECTION</strong> es una empresa líder en la <strong>producción</strong>,
                            <strong>importación</strong> y <strong>distribución</strong> de textiles de alta calidad para la
                            industria hotelera y del hogar. Con una amplia gama de productos que incluyen almohadas,
                            protectores, sábanas, fundas, edredones, toallas y frazadas, nos especializamos en ofrecer
                            soluciones personalizadas.
                        </p>
                        <a href="{{ route('nosotros') }}" class="btn_1">
                            Leer más &nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                            </svg>
                        </a>
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
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
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
    <section class="d-flex align-items-center"
        style="background: url({{ asset('assets/img/banner-2.jpg') }}) no-repeat center center; background-size: cover; background-attachment: fixed; min-height: 500px; overflow: hidden; position:relative">
        <div class="cover-pantalla" style="z-index: 1;"></div>
        <div class="container margin_120_95" id="fourth_section">
            <div class="row justify-content-between align-items-center position-relative" style="z-index: 10;">
                <div class="col-12 text-center text-white">
                    <h5 class="text-white">Almohadas</h5>
                    <h1 class="text-white">¡Conoce nuestras Almohadas para el descanso!</h1>
                    <a href="{{ route('tienda', ['categoriaId' => 1]) }}" class="btn_1">Ver Almohadas</a>
                </div>

            </div>
            <!-- /Row -->
        </div>
        <!-- /container-->
    </section>

    <section class="nuevos-lanzamientos-sec">
        <div class="container margin_120_95">
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <small
                        style="font-size: 11px; letter-spacing: 3px; color: #333; text-transform: uppercase; font-weight: 600;">Calidad
                        y diseño</small>
                    <h3 class="gilda-font mt-2" style="color: #D48A1F; font-size: 42px;">Nuevos Lanzamientos</h3>
                </div>
            </div>
            <div class="row align-items-center">
                <!-- Left Column -->
                <div class="col-md-5 pe-md-5 position-relative">
                    <!-- Cloud SVG -->
                    <div class="d-flex justify-content-end mb-3 position-absolute" style="top: -40px; right: 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="40" viewBox="0 0 24 24" fill="none"
                            stroke="#dcdcdc" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path>
                        </svg>
                    </div>

                    <h2 class="gilda-font mb-3" style="color: #D48A1F; font-size: 22px;">Nuestras Almohadas</h2>
                    <p style="font-size: 14px; color: #555; line-height: 1.6;">Son elaboradas con materiales de alta calidad
                        para lograr el confort y suavidad al tacto, están diseñadas especialmente para tu descanso.</p>

                    <ul class="list-unstyled mt-4" style="color: #444; font-size: 13px; line-height: 2.2;">
                        <li><span style="color: #D48A1F; margin-right: 8px;">✔</span> Materiales de alta calidad.</li>
                        <li><span style="color: #D48A1F; margin-right: 8px;">✔</span> Función Anti-Alérgico y Anti-Bacteria.
                        </li>
                        <li><span style="color: #D48A1F; margin-right: 8px;">✔</span> Diseño y confort.</li>
                        <li><span style="color: #D48A1F; margin-right: 8px;">✔</span> Más de 20 opciones disponibles.</li>
                    </ul>
                </div>

                <!-- Right Column -->
                <div class="col-md-7 position-relative mt-5 mt-md-0">
                    <img src="{{asset('assets/img/bebe.jpg')}}" class="w-100 shadow-sm" alt="Bebe descansando"
                        style="border-radius: 8px;">

                    <!-- Floating Image (small pillow) -->
                    <img src="{{asset('assets/img/almohadas_productos.png')}}" class="position-absolute"
                        style="width: 140px; bottom: 80px; left: -50px; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.15));"
                        alt="Almohada">

                    <div class="mt-4">
                        <h2 class="gilda-font mb-3" style="color: #D48A1F; font-size: 20px;">Almohadas para descanso, Bebés
                            o viaje</h2>
                        <a href="{{route('tienda')}}" class="btn_1 d-inline-flex align-items-center"
                            style="background-color: transparent; border: 1px dashed #D48A1F; color: #D48A1F; padding: 10px 30px; font-weight: 500; font-size: 14px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cart2 me-2" viewBox="0 0 16 16">
                                <path
                                    d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                            </svg>
                            Comprar Ahora
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- /Pattern  -->
    <div class="container margin_120_95" id="promo-section">
        <div class="row justify-content-between align-items-center">
            <div class="col-12">
                <div class="descripcion-nosotros">
                    <div class="title text-center">
                        <small>Últimas piezas</small>
                        <h3 class="titulo-nosotros mb-4">Productos en Promoción</h3>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    @foreach(productosEnOferta(4) as $producto)
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
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
    <section class="d-flex align-items-center"
        style="background: url({{ asset('assets/img/testimonios.jpg') }}) no-repeat center center; background-size: cover; background-attachment: fixed; min-height: 500px; overflow: hidden; position:relative">
        <div class="cover-pantalla" style="z-index: 1;"></div>
        <div class="container margin_120_95" id="fourth_section">
            <div class="row justify-content-between align-items-center position-relative" style="z-index: 10;">
                <div class="col-12 text-center text-white">
                    <h5 class="text-white">Testimonios</h5>
                    <h1 class="text-white">Lo que nuestros clientes opinan</h1>
                </div>
                <div class="col-12">
                    <div class="testimonios">
                        <div class="testimonio-item">
                            <div class="text-bubble">Los protectores de colchones son muy eficiente, me han salvado varias
                                veces</div>
                            <div class="autor-testimonio">
                                <img src="{{ asset('assets/img/author-3.jpg') }}" alt="">
                                <div>
                                    <h5 class="text-white mb-0">Francisco Cortés</h5>
                                    <small>Cliente</small>
                                </div>
                            </div>
                        </div>
                        <div class="testimonio-item">
                            <div class="text-bubble">Mi bebé descansa mucho mejor con su almohada especial para él.</div>
                            <div class="autor-testimonio">
                                <img src="{{ asset('assets/img/author-2.jpg') }}" alt="">
                                <div>
                                    <h5 class="text-white mb-0">Eduardo Lee</h5>
                                    <small>Cliente</small>
                                </div>
                            </div>
                        </div>
                        <div class="testimonio-item">
                            <div class="text-bubble">Me encanto mi almohada de viaje, la llevo a todas partes</div>
                            <div class="autor-testimonio">
                                <img src="{{ asset('assets/img/author-1.jpg') }}" alt="">
                                <div>
                                    <h5 class="text-white mb-0">Leticia Frank</h5>
                                    <small>Cliente</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Row -->
        </div>
        <!-- /container-->
    </section>

    <section style="background-color: #fbfbfb; padding-top: 80px; padding-bottom: 80px;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <div class="d-inline-block text-start position-relative">
                        <img src="{{asset('img/corona.png')}}"
                            style="width: 55px; position: absolute; top: -50px; left: -10px;" alt="Crown">
                            <h3 class="gilda-font text-center" style="color: #D48A1F; font-size: 52px;">¿Por qué elegirnos?</h3>
                        </div>
                        <p class="mt-3 mx-auto"
                            style="color: #666; font-size: 14px; font-family: 'Quicksand', sans-serif; max-width: 700px;">
                            Obtenga la mejor compra para su dinero utilizando los productos más populares entre nuestros
                            clientes</p>
                    </div>
                </div>
                <div class="row g-4">
                    <!-- Card 1 -->
                    <div class="col-md-4 text-center">
                        <div class="card-nosotros bg-white h-100"
                            style="padding: 40px 20px; box-shadow: 0 5px 25px rgba(0,0,0,0.03);">
                            <div class="card-content">
                                <div class="icon mb-3" style="color: #222;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                                        class="bi bi-award" viewBox="0 0 16 16">
                                        <path
                                            d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702z" />
                                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z" />
                                    </svg>
                                </div>
                                <div class="titulo-card gilda-font mb-2" style="color: #D48A1F; font-size: 24px;">Más de 10 años
                                    de experiencia</div>
                                <div class="descripcion-card"
                                    style="color: #777; font-size: 14px; font-family: 'Quicksand', sans-serif; line-height: 1.6;">
                                    La calidad de nuestros productos nos respaldan.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-4 text-center">
                        <div class="card-nosotros bg-white h-100"
                            style="padding: 40px 20px; box-shadow: 0 5px 25px rgba(0,0,0,0.03);">
                            <div class="card-content">
                                <div class="icon mb-3" style="color: #222;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                                        class="bi bi-shop" viewBox="0 0 16 16">
                                        <path
                                            d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z" />
                                    </svg>
                                </div>
                                <div class="titulo-card gilda-font mb-2" style="color: #D48A1F; font-size: 24px;">Más de 100
                                    modelos disponibles</div>
                                <div class="descripcion-card"
                                    style="color: #777; font-size: 14px; font-family: 'Quicksand', sans-serif; line-height: 1.6;">
                                    Contamos con más de 100 productos de alta calidad.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-4 text-center">
                        <div class="card-nosotros bg-white h-100"
                            style="padding: 40px 20px; box-shadow: 0 5px 25px rgba(0,0,0,0.03);">
                            <div class="card-content">
                                <div class="icon mb-3" style="color: #222;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                                        class="bi bi-heart" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                </div>
                                <div class="titulo-card gilda-font mb-2" style="color: #D48A1F; font-size: 24px;">+ 1000
                                    clientes felices</div>
                                <div class="descripcion-card"
                                    style="color: #777; font-size: 14px; font-family: 'Quicksand', sans-serif; line-height: 1.6;">
                                    Por que nos importa tu descanso.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-md-4 text-center">
                        <div class="card-nosotros bg-white h-100"
                            style="padding: 40px 20px; box-shadow: 0 5px 25px rgba(0,0,0,0.03);">
                            <div class="card-content">
                                <div class="icon mb-3" style="color: #222;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                                        class="bi bi-shield-check" viewBox="0 0 16 16">
                                        <path
                                            d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56" />
                                        <path
                                            d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                    </svg>
                                </div>
                                <div class="titulo-card gilda-font mb-2" style="color: #D48A1F; font-size: 24px;">Seguridad en
                                    tu compra</div>
                                <div class="descripcion-card"
                                    style="color: #777; font-size: 14px; font-family: 'Quicksand', sans-serif; line-height: 1.6;">
                                    Protegemos tu información al comprar en nuestro sitio web.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="col-md-4 text-center">
                        <div class="card-nosotros bg-white h-100"
                            style="padding: 40px 20px; box-shadow: 0 5px 25px rgba(0,0,0,0.03);">
                            <div class="card-content">
                                <div class="icon mb-3" style="color: #222;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                                        class="bi bi-truck" viewBox="0 0 16 16">
                                        <path
                                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                                    </svg>
                                </div>
                                <div class="titulo-card gilda-font mb-2" style="color: #D48A1F; font-size: 24px;">Envío a toda
                                    Panamá</div>
                                <div class="descripcion-card"
                                    style="color: #777; font-size: 14px; font-family: 'Quicksand', sans-serif; line-height: 1.6;">
                                    Cubrimos todas las entidades.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div class="col-md-4 text-center">
                        <div class="card-nosotros bg-white h-100"
                            style="padding: 40px 20px; box-shadow: 0 5px 25px rgba(0,0,0,0.03);">
                            <div class="card-content">
                                <div class="icon mb-3" style="color: #222;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                                        class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path
                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                    </svg>
                                </div>
                                <div class="titulo-card gilda-font mb-2" style="color: #D48A1F; font-size: 24px;">Atención al
                                    cliente</div>
                                <div class="descripcion-card"
                                    style="color: #777; font-size: 14px; font-family: 'Quicksand', sans-serif; line-height: 1.6;">
                                    info@pandoraimports.net</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- /Pattern  -->
        <div class="container margin_120_95" id="fifth_section">
            <div class="row justify-content-between align-items-center">
                <div class="col-12">
                    <div class="descripcion-nosotros">
                        <div class="title text-center mb-5">
                            <small class="blog-section-subtitle">NUESTRO BLOG</small>
                            <h3 class="blog-section-title">Consejos, notas tip's y mucho más</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        @foreach(postsPublicos(3) as $post)
                            <div class="col-12 col-md-4 mb-4">
                                <div class="blog-card">
                                    <div class="blog-card-img-wrap">
                                        <a href="{{ route('blog.detalle', $post->slug) }}">
                                            <img src="{{ $post->imagen() }}" alt="{{ $post->nombre }}" class="blog-card-img">
                                        </a>
                                        <span class="blog-card-badge">
                                            {{ strtoupper($post->categoria() ?? 'CONSEJOS') }}
                                        </span>
                                    </div>
                                    <div class="blog-card-body">
                                        <a href="{{ route('blog.detalle', $post->slug) }}" class="blog-card-title-link">
                                            <h4 class="blog-card-title">{{ Str::limit($post->nombre, 80) }}</h4>
                                        </a>
                                        <a href="{{ route('blog.detalle', $post->slug) }}" class="blog-card-link">LEER MÁS »</a>
                                    </div>
                                    <div class="blog-card-footer">
                                        {{ $post->created_at ? $post->created_at->translatedFormat('d F, Y') : '12 junio, 2022' }} •
                                        2 comentarios
                                    </div>
                                </div>
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
    <style>
        /* Slick Slider Custom Styles */
        .slider-hero {
            position: relative;
        }

        .slider-hero .slick-prev,
        .slider-hero .slick-next {
            z-index: 10;
            width: 45px;
            height: 45px;
            background-color: #111;
            border: none;
            border-radius: 0;
            transition: background-color 0.3s;
            display: flex !important;
            align-items: center;
            justify-content: center;
        }

        .slider-hero .slick-prev {
            left: 0;
        }

        .slider-hero .slick-next {
            right: 0;
        }

        .slider-hero .slick-prev:hover,
        .slider-hero .slick-next:hover,
        .slider-hero .slick-prev:focus,
        .slider-hero .slick-next:focus {
            background-color: #111;
            outline: none;
        }

        .slider-hero .slick-prev:before {
            content: "";
            display: block;
            width: 12px;
            height: 12px;
            border-top: 1px solid #fff;
            border-left: 1px solid #fff;
            transform: rotate(-45deg);
            margin-left: 4px;
            opacity: 1;
        }

        .slider-hero .slick-next:before {
            content: "";
            display: block;
            width: 12px;
            height: 12px;
            border-top: 1px solid #fff;
            border-right: 1px solid #fff;
            transform: rotate(45deg);
            margin-right: 4px;
            opacity: 1;
        }

        .slider-hero .slick-dots {
            bottom: 30px;
            z-index: 10;
        }

        .slider-hero .slick-dots li button:before {
            font-size: 12px;
            color: white;
            opacity: 0.5;
        }

        .slider-hero .slick-dots li.slick-active button:before {
            color: #D48A1F !important;
            opacity: 1;
        }

        /* Category Slider Custom Styles */
        .categorias-slider .slick-prev,
        .categorias-slider .slick-next {
            z-index: 10;
            width: 45px;
            height: 45px;
            background-color: #111;
            border: none;
            border-radius: 0;
            transition: background-color 0.3s;
            display: flex !important;
            align-items: center;
            justify-content: center;
        }

        .categorias-slider .slick-prev {
            left: 0;
        }

        .categorias-slider .slick-next {
            right: 0;
        }

        .categorias-slider .slick-prev:hover,
        .categorias-slider .slick-next:hover,
        .categorias-slider .slick-prev:focus,
        .categorias-slider .slick-next:focus {
            background-color: #111;
            outline: none;
        }

        .categorias-slider .slick-prev:before {
            content: "";
            display: block;
            width: 12px;
            height: 12px;
            border-top: 1px solid #fff;
            border-left: 1px solid #fff;
            transform: rotate(-45deg);
            margin-left: 4px;
            opacity: 1;
        }

        .categorias-slider .slick-next:before {
            content: "";
            display: block;
            width: 12px;
            height: 12px;
            border-top: 1px solid #fff;
            border-right: 1px solid #fff;
            transform: rotate(45deg);
            margin-right: 4px;
            opacity: 1;
        }
    </style>
    <script>
        $('.slider-hero').slick({
            arrows: true,
            dots: true,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 5000,
            fade: true,
            cssEase: 'linear'
        });

        $('.categorias-slider').slick({
            arrows: true,
            dots: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 3000,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('.testimonios').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 300,
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            responsive: [
                // {
                //     breakpoint: 1024,
                //     settings: {
                //         slidesToShow: 2,
                //         slidesToScroll: 1,
                //         infinite: true,
                //         dots: true
                //     }
                // },
                {
                    breakpoint: 540,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

    </script>
@endsection