<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name') }} @yield('titulo')</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo') }}">
    <link rel="apple-touch-icon" type="image/x-icon"
        href="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
        href="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="{{ asset('storage/imagenes') . '/' . opcionSlug('logotipo') }}">

    <!-- GOOGLE WEB FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
                                <li><a href="{{ route('home')}}" class="animated_link">Inicio</a></li>
                                <li><a href="{{ route('tienda')}}" class="animated_link">Tienda</a></li>
                                <li><a href="{{ route('nosotros')}}" class="animated_link">Nosotros</a></li>
                                <li><a href="{{ route('tienda')}}" class="animated_link">Mayoreo</a></li>
                                <li><a href="{{ route('contacto') }}" class="animated_link">Contacto</a></li>
                                <li><a href="{{ route('blog')}}" class="animated_link">Blog</a></li>
                                
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
                    <div class="d-flex">
                        @guest
                            <a href="{{ route('login')}}" class="animated_link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('panel')}}" class="animated_link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                </svg>
                            </a>
                        @endguest
                        <li>@livewire('carrito-boton-component')</li>
                    </div>
                </div>
            </div>
        </div><!-- container -->
    </header><!-- End Header -->

    <main>
        @yield('content')
    </main>

    <footer class="revealed">
        <div class="footer_bg">
            <!-- <div class="gradient_over"></div> -->
            <div class="background-image d-flex align-items-center" data-background="url({{ asset('storage/imagenes') . '/' . opcionSlug('imagen_web')}})">

                <div class="container">
                

                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-4">
                            <img src="{{ asset('assets/img/logo-pnd.png') }}" class="img-fluid" style="max-width: 200px;" alt="">
                            <h3 class="text-white">Descanso superior. Telas suaves, transpirables y duraderas</h3>
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                            <img src="{{ asset('assets/img/logo_blanco.png')  }}" class="img-fluid logo-footer" alt="">
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                           <div class="w-100 text-right">
                                <h5 class="text-center">Contáctenos</h5>
                                <ul>
                                    <li class="text-center"><strong><a href="mailto:{{ opcionSlug('email_contacto') }}" class="text-white">{{ opcionSlug('email_contacto') }}</a></strong></li>
                                    <li class="text-center"><strong><a href="tel:{{ opcionSlug('telefono_contacto') }}" class="text-white">{{ opcionSlug('telefono_contacto') }}</a></strong></li>
                                    <li class="text-center">{{ opcionSlug('direccion') }}</li>
                                </ul>
                                <div class="mt-3 d-flex justify-content-center">
                                    <ul class="d-flex gap-4 list-unstyled">
                                        <li><a href="{{ opcionSlug('red_instagram') }}" class="text-white"><i class="bi bi-instagram"></i></a></li>
                                        <li><a href="{{ opcionSlug('red_whatsapp') }}" class="text-white"><i class="bi bi-whatsapp"></i></a></li>
                                        <li><a href="{{ opcionSlug('red_facebook') }}" class="text-white"><i class="bi bi-facebook"></i></a></li>
                                        <li><a href="{{ opcionSlug('red_twitter') }}" class="text-white"><i class="bi bi-twitter-x"></i></a></li>
                                    </ul>
                                </div>
                           </div>
                            
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-center justify-content-lg-start">
                                    <span>© {{ date('Y') }}. {{ config('app.name') }}, All rights reserved.</span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center justify-content-lg-end">
                                    <span>Website developed by | <a href="https://ewebpanama.top" target="_blank">ewebPanamá</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                </div>
                <!--/container-->

            </div>
        </div>
       
        
    </footer>
    <!-- /footer -->

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- /back to top -->
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
        $('body').on('click', '.agregar-carrito', function (e) {
            e.preventDefault();
            // Buscar el input .cantidad-carrito dentro del mismo frame-producto
            var cantidad = $(this).closest('.frame-producto').find('.cantidad-carrito').val();
            var productoId = $(this).data('id');

            // Asegurar que la cantidad sea al menos 1
            cantidad = parseInt(cantidad) || 1;
            if (cantidad < 1) cantidad = 1;

            Livewire.emit('addProducto', productoId, cantidad);
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

</body>

</html>