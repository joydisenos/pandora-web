<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name') }} @yield('titulo')</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('img/corona.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon"
        href="{{ asset('img/corona.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
        href="{{ asset('img/corona.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="{{ asset('img/corona.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="{{ asset('img/corona.png') }}">

    <!-- GOOGLE WEB FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gilda+Display&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500&family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/js/app.js'])
    <!-- BASE CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/vendors.min.css')}}" rel="stylesheet">
    @yield('header')
    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('assets/css/custom.css')}}" rel="stylesheet">
    @include('includes.styles')
    <style>
        /* Typography */
        body, p, a, span, div, button, input, select, textarea {
            font-family: 'Quicksand', sans-serif !important;
        }
        h1, h2, h3, h4, h5, h6, .gilda-font {
            font-family: 'Gilda Display', serif !important;
        }

        /* Flip Card Styles */
        .flip-card {
            background-color: transparent;
            perspective: 1000px;
            width: 100%;
            height: 250px;
            margin-bottom: 15px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            border: 1px solid #ddd;
        }

        .frame-producto:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .flip-card-front {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .flip-card-front img {
            max-height: 100%;
            max-width: 100%;
            object-fit: cover;
        }

        .flip-card-back {
            background-color: #fff;
            transform: rotateY(180deg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Variant Buttons */
        .variant-square {
            display: inline-block;
            border: 1px solid #ccc;
            padding: 5px 10px;
            margin-right: 5px;
            margin-bottom: 5px;
            cursor: pointer;
            font-size: 12px;
            background: #fff;
            transition: 0.2s;
        }
        .variant-square:hover {
            border-color: #d48a1f;
        }
        .variant-square.selected {
            background-color: #d48a1f;
            color: #fff;
            border-color: #d48a1f;
        }

        /* Disabled Add to Cart */
        .btn-add-disabled {
            background-color: #f1eee9 !important;
            color: #a3a3a3 !important;
            pointer-events: none;
            border: none !important;
        }

        /* Tienda Category Buttons */
        .inactive-cat {
            background-color: #fff !important;
            color: #D48A1F !important;
            border: 1px solid #D48A1F !important;
            border-radius: 0;
            padding: 12px;
            font-size: 1.05rem;
        }
        .inactive-cat:hover, .inactive-cat:focus {
            background-color: #fff !important;
            color: #D48A1F !important;
            border-color: #D48A1F !important;
            box-shadow: none !important;
        }
        .active-cat {
            background-color: #000 !important;
            color: #fff !important;
            border: 1px solid #000 !important;
            border-radius: 0;
            padding: 12px;
            font-size: 1.05rem;
        }
        .active-cat:hover, .active-cat:focus {
            background-color: #000 !important;
            color: #fff !important;
            border-color: #000 !important;
            box-shadow: none !important;
        }
        /* Default state: white links and icons */
        header.fixed_header nav ul li a,
        header.fixed_header .col-2 ul li a {
            color: #fff !important;
            transition: color 0.3s ease;
        }
        
        /* Default state hover: orange */
        header.fixed_header nav ul li a:hover,
        header.fixed_header .col-2 ul li a:hover {
            color: #D48A1F !important;
        }

        /* Sticky state: black links and icons */
        header.fixed_header.sticky nav ul li a,
        header.fixed_header.sticky .col-2 ul li a {
            color: #000 !important;
        }

        /* Sticky state hover: orange */
        header.fixed_header.sticky nav ul li a:hover,
        header.fixed_header.sticky .col-2 ul li a:hover {
            color: #D48A1F !important;
        }

        /* Remove bottom line effect */
        header.fixed_header nav ul li a.animated_link:before,
        header.fixed_header nav ul li a.animated_link:after,
        header.fixed_header .col-2 ul li a.animated_link:before,
        header.fixed_header .col-2 ul li a.animated_link:after {
            display: none !important;
        }
    </style>
</head>

<body>

    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Page Preload -->

    <header class="fixed_header menu_v4">
        <div class="layer"></div><!-- Opacity Mask -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-2">
                    <a href="{{ route('home') }}" class="logo_normal"><img
                            src="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo') }}" width="185" alt=""></a>
                    <a href="{{ route('home') }}" class="logo_sticky"><img
                            src="{{ asset('assets/img/logo_pandora.png') }}" width="185" alt=""></a>
                </div>
                
                <div class="col-8">
                    <div class="main-menu">
                        <a href="#" class="closebt open_close_menu"><i class="bi bi-x"></i></a>
                        <div class="logo_panel"><img
                                src="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo') }}" width="135" alt="">
                        </div>
                        
                        <nav id="mainNav">
                            <ul>
                                <li><a href="{{ route('home')}}" class="animated_link text-uppercase">INICIO</a></li>
                                <li><a href="{{ route('tienda')}}" class="animated_link text-uppercase">TIENDA</a></li>
                                <li><a href="{{ route('nosotros')}}" class="animated_link text-uppercase">NOSOTROS</a></li>
                                <li><a href="{{ route('mayoreo')}}" class="animated_link text-uppercase">MAYOREO</a></li>
                                <li><a href="{{ route('contacto') }}" class="animated_link text-uppercase">CONTACTO</a></li>
                                <li><a href="{{ route('blog')}}" class="animated_link text-uppercase">BLOG</a></li>
                                
                            </ul>
                        </nav>
                    </div>
                    <div class="hamburger_2 open_close_menu float-end">
                        <div class="hamburger__box">
                            <div class="hamburger__inner"></div>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <ul class="d-flex align-items-center justify-content-end list-unstyled mb-0 gap-3">
                        <li>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#searchModal" class="animated_link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('wishlist') }}" class="animated_link position-relative d-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                </svg>
                                @livewire('wishlist-boton-component')
                            </a>
                        </li>
                        <li>
                            @guest
                                <a href="{{ route('login')}}" class="animated_link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('panel')}}" class="animated_link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    </svg>
                                </a>
                            @endguest
                        </li>
                        <li>@livewire('carrito-boton-component')</li>
                    </ul>
                </div>
            </div>
        </div><!-- container -->
    </header><!-- End Header -->

    <main>
        @yield('content')
    </main>

    <!-- Newsletter Section (Full Width Background, Boxed Content) -->
    <section class="newsletter-section">
        <div class="container newsletter-container">
            <div class="row justify-content-center mb-0">
                <div class="col-lg-4 col-md-4 newsletter-graphics-container position-relative">
                    <!-- Dotted curved line connecting Envelope and Mailbox -->
                    <svg class="newsletter-dashed-line d-none d-lg-block" viewBox="0 0 1000 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M50,60 Q 250,15 500,50 T 950,40" stroke="#c58c43" stroke-width="1.5" stroke-dasharray="5,5" />
                    </svg>

                    <!-- Flying Envelope on Left -->
                    <div class="newsletter-envelope d-none d-lg-block">
                        <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" width="75">
                            <rect x="6" y="16" width="52" height="34" rx="3" fill="#ffffff" stroke="#171f24" stroke-width="2.5" stroke-linejoin="round"/>
                            <path d="M6 17L32 35L58 17" stroke="#171f24" stroke-width="2.5" stroke-linejoin="round"/>
                            <path d="M12 25L24 33" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M52 25L40 33" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>

                    <!-- Open Mailbox on Right -->
                    <div class="newsletter-mailbox d-none d-lg-block">
                        <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" width="90">
                            <path d="M40 50V75" stroke="#718096" stroke-width="4" stroke-linecap="round"/>
                            <path d="M22 22H52C58 22 58 48 52 48H22V22Z" fill="#2b6cb0" stroke="#171f24" stroke-width="2.5" stroke-linejoin="round"/>
                            <path d="M22 48H10V38H22" fill="#2d3748" stroke="#171f24" stroke-width="2.5" stroke-linejoin="round"/>
                            <path d="M48 22V8H54V12H48" fill="#e53e3e" stroke="#171f24" stroke-width="2" stroke-linejoin="round"/>
                            <rect x="14" y="28" width="22" height="14" rx="1" fill="#ffffff" stroke="#171f24" stroke-width="2" transform="rotate(-5 25 35)"/>
                            <path d="M14 31L25 37L36 31" stroke="#171f24" stroke-width="1.5"/>
                        </svg>
                    </div>
                </div>
            </div>
            <!-- Subscription Form -->
            <div class="newsletter-content">
                <h3 class="newsletter-title">Newsletter</h3>
                <p class="newsletter-subtitle">Recibe promociones, ofertas, descuentos exclusivos, noticias y mucho más.</p>
                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('¡Gracias por suscribirte!');">
                    <div class="newsletter-form-group">
                        <input type="email" class="newsletter-input" placeholder="Correo electrónico" required>
                        <button type="submit" class="newsletter-button">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Continuous Jagged/Wavy Divisor (Black/Dark) -->
    <div class="scallop-divider"></div>

    <!-- Main Dynamic Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row gy-4 justify-content-between">
                
                <!-- Column 1: Brand & Contact Info -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="pe-lg-4">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo') }}" class="footer-brand-logo" alt="Pandora Hotel Collection">
                        </a>
                        <p class="footer-brand-text">Manejamos altos estándares en todos nuestros productos.</p>
                        
                        <ul class="footer-contact-list">
                            <li class="footer-contact-item">
                                <span class="footer-contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                    </svg>
                                </span>
                                <span class="footer-contact-text">{{ opcionSlug('direccion') ?: 'Galerias Procosa, Local #13. Villa Zaita. Ciudad de Panamá.' }}</span>
                            </li>
                            <li class="footer-contact-item">
                                <span class="footer-contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.884.511z"/>
                                    </svg>
                                </span>
                                <span class="footer-contact-text">
                                    <a href="tel:+50761783500">(+507) 6178-3500</a>
                                </span>
                            </li>
                            <li class="footer-contact-item">
                                <span class="footer-contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.884.511z"/>
                                    </svg>
                                </span>
                                <span class="footer-contact-text">
                                    <a href="tel:+50766247780">(+507) 6624-7780</a>
                                </span>
                            </li>
                            <li class="footer-contact-item">
                                <span class="footer-contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.884.511z"/>
                                    </svg>
                                </span>
                                <span class="footer-contact-text">
                                    <a href="tel:+5073876729">(+507) 387-6729</a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Column 2: Dynamic Categories -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <h4 class="footer-column-title">Categorías</h4>
                    <ul class="footer-links-list">
                        @foreach(categoriasPublicas() as $cat)
                            <li class="footer-link-item">
                                <a href="{{ route('tienda', ['categoriaId' => $cat->id]) }}" class="footer-link">
                                    <span>{{ $cat->nombre }}</span>
                                    <span class="footer-link-arrow">→</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Column 3: Website Links -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <h4 class="footer-column-title">Sitio Web</h4>
                    <ul class="footer-links-list">
                        <li class="footer-link-item">
                            <a href="{{ route('home') }}" class="footer-link">
                                <span>Inicio</span>
                                <span class="footer-link-arrow">→</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="{{ route('nosotros') }}" class="footer-link">
                                <span>Nosotros</span>
                                <span class="footer-link-arrow">→</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="{{ route('tienda') }}" class="footer-link">
                                <span>Tienda</span>
                                <span class="footer-link-arrow">→</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="{{ route('mayoreo') }}" class="footer-link">
                                <span>Mayoreo</span>
                                <span class="footer-link-arrow">→</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="{{ route('contacto') }}" class="footer-link">
                                <span>Contacto</span>
                                <span class="footer-link-arrow">→</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="{{ route('blog') }}" class="footer-link">
                                <span>Blog</span>
                                <span class="footer-link-arrow">→</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Legal Links -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <h4 class="footer-column-title">Legal</h4>
                    <ul class="footer-links-list">
                        <li class="footer-link-item">
                            <a href="/terminos-y-condiciones" class="footer-link">
                                <span>Términos y condiciones</span>
                                <span class="footer-link-arrow">→</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/politicas-de-privacidad" class="footer-link">
                                <span>Política de privacidad</span>
                                <span class="footer-link-arrow">→</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/politica-de-cambios-y-garantia" class="footer-link">
                                <span>Política de servicio</span>
                                <span class="footer-link-arrow">→</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/politica-de-cambios-y-garantia" class="footer-link">
                                <span>Políticas de Cancelación, Devolución y Reembolso</span>
                                <span class="footer-link-arrow">→</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/contacto" class="footer-link">
                                <span>Reclamos</span>
                                <span class="footer-link-arrow">→</span>
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/preguntas-frecuentes" class="footer-link">
                                <span>Preguntas frecuentes</span>
                                <span class="footer-link-arrow">→</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>

    <!-- Bottom Bar: Rights, Social Media & Payment Cards -->
    <section class="footer-bottom-bar">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                
                <!-- Privacy Statement -->
                <div class="col-md-4 text-center text-md-start">
                    <a href="/politicas-de-privacidad" class="footer-privacy-link">Aviso de privacidad</a>
                </div>

                <!-- Social Networks -->
                <div class="col-md-4 my-3 my-md-0 text-center">
                    <ul class="footer-social-links">
                        @if(opcionSlug('red_facebook'))
                            <li class="footer-social-item">
                                <a href="{{ opcionSlug('red_facebook') }}" target="_blank" title="Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                    </svg>
                                </a>
                            </li>
                        @endif
                        @if(opcionSlug('red_instagram'))
                            <li class="footer-social-item">
                                <a href="{{ opcionSlug('red_instagram') }}" target="_blank" title="Instagram">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.444-.048-3.298c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.93 2.853a.997.997 0 1 0 0-1.993.997.997 0 0 0 0 1.993zM8 4.01a3.99 3.99 0 1 0 0 7.98 3.99 3.99 0 0 0 0-7.98zm0 1.442a2.548 2.548 0 1 1 0 5.096 2.548 2.548 0 0 1 0-5.096z"/>
                                    </svg>
                                </a>
                            </li>
                        @endif
                        @if(opcionSlug('red_twitter'))
                            <li class="footer-social-item">
                                <a href="{{ opcionSlug('red_twitter') }}" target="_blank" title="Twitter">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"/>
                                    </svg>
                                </a>
                            </li>
                        @endif
                        <li class="footer-social-item">
                            <a href="#" target="_blank" title="Pinterest">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                    <path d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907a.23.23 0 0 1-.17.17c-.772-.359-1.25-1.488-1.25-2.394 0-2.585 1.879-4.96 5.417-4.96 2.844 0 5.053 2.026 5.053 4.733 0 2.826-1.782 5.1-4.256 5.1-.83 0-1.612-.431-1.879-.94l-.51 1.94c-.185.711-.681 1.602-1.015 2.15A8.002 8.002 0 1 0 8 0z"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Payment Methods (RETINA SVG) -->
                <div class="col-md-4 text-center text-md-end">
                    <div class="footer-payment-icons">
                        <!-- Mastercard -->
                        <svg class="footer-payment-badge" viewBox="0 0 38 24" width="38" height="24">
                            <rect width="38" height="24" rx="3" fill="#1e293b"/>
                            <circle cx="15" cy="12" r="7" fill="#eb001b"/>
                            <circle cx="23" cy="12" r="7" fill="#ff5f00" opacity="0.8"/>
                        </svg>
                        <!-- American Express -->
                        <svg class="footer-payment-badge" viewBox="0 0 38 24" width="38" height="24">
                            <rect width="38" height="24" rx="3" fill="#016fd0"/>
                            <text x="50%" y="58%" fill="white" font-family="'Montserrat', sans-serif" font-weight="bold" font-size="7" text-anchor="middle" letter-spacing="0.5">AMEX</text>
                        </svg>
                        <!-- Visa -->
                        <svg class="footer-payment-badge" viewBox="0 0 38 24" width="38" height="24">
                            <rect width="38" height="24" rx="3" fill="#ffffff" stroke="#e2e8f0" stroke-width="1"/>
                            <text x="50%" y="62%" fill="#1a1f71" font-family="'Montserrat', sans-serif" font-weight="900" font-style="italic" font-size="9" text-anchor="middle">VISA</text>
                        </svg>
                        <!-- Discover -->
                        <svg class="footer-payment-badge" viewBox="0 0 38 24" width="38" height="24">
                            <rect width="38" height="24" rx="3" fill="#f6891f"/>
                            <text x="50%" y="58%" fill="white" font-family="'Montserrat', sans-serif" font-weight="bold" font-size="6" text-anchor="middle">DISCOVER</text>
                        </svg>
                        <!-- PayPal -->
                        <svg class="footer-payment-badge" viewBox="0 0 38 24" width="38" height="24">
                            <rect width="38" height="24" rx="3" fill="#ffffff" stroke="#e2e8f0" stroke-width="1"/>
                            <text x="50%" y="60%" fill="#003087" font-family="'Montserrat', sans-serif" font-weight="bold" font-style="italic" font-size="8" text-anchor="middle">Pay<tspan fill="#0079c1">Pal</tspan></text>
                        </svg>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- /back to top -->
    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background-color: rgba(255, 255, 255, 0.85); border: none;">
                <div class="modal-header border-0 pt-4 pe-4">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.5rem;"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <form action="{{ route('tienda') }}" method="GET" class="w-100" style="max-width: 600px;">
                        <div class="input-group input-group-lg">
                            <input type="text" name="buscar" class="form-control border-0 border-bottom bg-transparent shadow-none" placeholder="Buscar productos..." style="font-size: 2rem; border-radius: 0; border-color: #000 !important; color: #000;" autofocus required>
                            <button class="btn btn-link text-dark shadow-none" type="submit" style="font-size: 2rem; border: none; border-radius: 0; padding-right: 0; padding-left: 1rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @stack('modals')
    @livewireScripts
    <!-- COMMON SCRIPTS -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/common_scripts.js') }}"></script>
    <script src="{{ asset('assets/js/common_functions.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker_search.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker_inline.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- <script src="{{ asset('assets/js/validate.js') }}"></script> -->

    @yield('scripts')
    <script>
        function selectVariantCard(element, type) {
            var container = $(element).closest('.variants-container');
            var frame = $(element).closest('.frame-producto');
            var btnCarrito = frame.find('.agregar-carrito');
            var val = $(element).data('val');

            // Toggle selection
            if ($(element).hasClass('selected')) {
                $(element).removeClass('selected');
                if(type === 'talla') btnCarrito.attr('data-talla', '');
                if(type === 'color') btnCarrito.attr('data-color', '');
            } else {
                // Deselect siblings
                container.find('.v-' + type).removeClass('selected');
                $(element).addClass('selected');
                if(type === 'talla') btnCarrito.attr('data-talla', val);
                if(type === 'color') btnCarrito.attr('data-color', val);
            }

            // Validate requirements
            var reqTalla = container.data('req-talla') === true || container.data('req-talla') === 'true';
            var reqColor = container.data('req-color') === true || container.data('req-color') === 'true';
            
            var hasTalla = btnCarrito.attr('data-talla') !== '';
            var hasColor = btnCarrito.attr('data-color') !== '';

            var valid = true;
            if(reqTalla && !hasTalla) valid = false;
            if(reqColor && !hasColor) valid = false;

            if (valid) {
                btnCarrito.removeClass('btn-add-disabled');
            } else {
                btnCarrito.addClass('btn-add-disabled');
            }
        }

        $('body').on('click', '.agregar-carrito', function (e) {
            e.preventDefault();
            if ($(this).hasClass('btn-add-disabled')) {
                // If it's disabled, maybe show an alert or just do nothing
                return;
            }

            // Buscar el input .cantidad-carrito dentro del mismo frame-producto
            var cantidad = $(this).closest('.frame-producto').find('.cantidad-carrito').val();
            var productoId = $(this).data('id');
            var talla = $(this).attr('data-talla') || null;
            var color = $(this).attr('data-color') || null;

            // Asegurar que la cantidad sea al menos 1
            cantidad = parseInt(cantidad) || 1;
            if (cantidad < 1) cantidad = 1;

            Livewire.emit('addProducto', productoId, cantidad, talla, color);
        });

        $('body').on('click', '.agregar-favorito', function (e) {
            e.preventDefault();
            var productoId = $(this).data('id');
            Livewire.emit('addFavorito', productoId);
        });

        $('body').on('click', '.agregar-carrito-detalle', function (e) {
            e.preventDefault();
            Livewire.emit('addProducto', $(this).data('id') , $('#quantityInput').val() );
        });
        Livewire.on('notificar', function (message) {
            console.log(message);
            if(message.tipo == 'success') {
                toastr.success(message.mensaje);
            } 
            if(message.tipo == 'info') {
                toastr.warning(message.mensaje);
            }
            if(message.tipo == 'error') {
                toastr.error(message.mensaje);
            }
        });
    </script>

    <!-- Privacy Policy Modal -->
    <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" style="z-index: 1055;">
        <div class="modal-content" style="border-radius: 0;">
          <div class="modal-header">
            <h5 class="modal-title fw-bold" id="privacyModalLabel">Política de Privacidad</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="font-size: 0.95rem; text-align: justify;">
            {!! nl2br(opcionSlug('politica_privacidad')) !!}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn text-white fw-bold" data-bs-dismiss="modal" style="border-radius: 0; background-color: #D48A1F;">Entendido</button>
          </div>
        </div>
      </div>
    </div>

</body>

</html>