@extends('layouts.principal')
@section('header')  
@endsection

@section('content')
 <div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset('assets/img/actualidad_riviera_blog.webp') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <h1 class="slide-animated two text-white" style="color: #D48A1F !important; font-family: 'Gilda Display', serif;">Mayoreo</h1>
        </div>
    </div>
</div>

<section style="padding: 80px 0; background: #fff;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 pe-md-5">
                <h3 class="gilda-font mb-4" style="color: #D48A1F; font-size: 32px;">Ventas al Mayor</h3>
                <p style="color: #666; font-family: 'Quicksand', sans-serif; font-size: 15px; line-height: 1.8; margin-bottom: 30px;">
                    Si cuentas con una tienda o local y quieres comenzar a vender nuestros productos contáctanos y de manera rápida nos pondremos en contacto contigo para brindarte todos los detalles para comenzar a vender nuestros productos.
                </p>
                <a href="#contacto-mayoreo" class="btn_1" style="background-color: transparent; border: 2px dashed #D48A1F; color: #D48A1F; font-family: 'Quicksand', sans-serif; font-weight: 600; text-transform: uppercase; padding: 10px 30px;">
                    CONTÁCTANOS
                </a>
            </div>
            <div class="col-md-6 mt-4 mt-md-0 text-center">
                <img src="{{ asset('img/mayoreo-1.jpg') }}" class="img-fluid rounded" style="max-height: 500px; width: 100%; object-fit: cover;" alt="Ventas al Mayor">
            </div>
        </div>
    </div>
</section>

<section style="padding: 80px 0; background: #fbfbfb;">
    <div class="container text-center">
        <h3 class="gilda-font mb-5" style="color: #D48A1F; font-size: 42px;">Los pasos son sencillos:</h3>
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-2">
                <h1 style="font-size: 72px; color: #333; font-weight: bold; margin-bottom: 10px;">1</h1>
                <p style="font-size: 14px; font-family: 'Quicksand', sans-serif; color: #555; line-height: 1.5;">Envía la información de tu empresa a través de nuestro formulario.</p>
            </div>
            <div class="col-6 col-md-2">
                <h1 style="font-size: 72px; color: #333; font-weight: bold; margin-bottom: 10px;">2</h1>
                <p style="font-size: 14px; font-family: 'Quicksand', sans-serif; color: #555; line-height: 1.5;">Envía la información de tu empresa a través de nuestro formulario.</p>
            </div>
            <div class="col-6 col-md-2">
                <h1 style="font-size: 72px; color: #333; font-weight: bold; margin-bottom: 10px;">3</h1>
                <p style="font-size: 14px; font-family: 'Quicksand', sans-serif; color: #555; line-height: 1.5;">Envía la información de tu empresa a través de nuestro formulario.</p>
            </div>
            <div class="col-6 col-md-2">
                <h1 style="font-size: 72px; color: #333; font-weight: bold; margin-bottom: 10px;">4</h1>
                <p style="font-size: 14px; font-family: 'Quicksand', sans-serif; color: #555; line-height: 1.5;">Envía la información de tu empresa a través de nuestro formulario.</p>
            </div>
            <div class="col-6 col-md-2">
                <h1 style="font-size: 72px; color: #333; font-weight: bold; margin-bottom: 10px;">5</h1>
                <p style="font-size: 14px; font-family: 'Quicksand', sans-serif; color: #555; line-height: 1.5;">Envía la información de tu empresa a través de nuestro formulario.</p>
            </div>
        </div>
    </div>
</section>

<section id="contacto-mayoreo" style="padding: 80px 0; background: #fff;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0 text-center">
                <img src="{{ asset('img/mayoreo-2.jpg') }}" class="img-fluid rounded" style="max-height: 500px; object-fit: cover; width: 100%;" alt="Contactanos">
            </div>
            <div class="col-md-6 ps-md-5">
                <h3 class="gilda-font mb-3" style="color: #D48A1F; font-size: 28px;">Enviar Información</h3>
                <p style="color: #666; font-family: 'Quicksand', sans-serif; font-size: 14px; margin-bottom: 30px;">
                    Llena este pequeño formulario y uno de nuestros ejecutivos te contactará a la brevedad.
                </p>
                
                @if(session('status'))
                    <div class="alert alert-success mb-4">{{ session('status') }}</div>
                @endif
                
                <form action="{{ route('enviar.contacto') }}" method="POST">
                    @csrf
                    <!-- Campo Oculto de Asunto Personalizado -->
                    <input type="hidden" name="asunto" value="Venta de mayoreo desde la web">
                    
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nombre" placeholder="Nombre" style="border: 1px solid #eee; border-radius: 0; padding: 12px; font-size: 13px;" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="email" name="email" placeholder="Email" style="border: 1px solid #eee; border-radius: 0; padding: 12px; font-size: 13px;" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="email" name="email_confirmation" placeholder="Confirmación Email" style="border: 1px solid #eee; border-radius: 0; padding: 12px; font-size: 13px;" required>
                    </div>
                    <div class="mb-3">
                        <!-- Usamos el campo mensaje para que pase la validación obligatoria del route() backend general de contactos -->
                        <input class="form-control" type="text" name="mensaje" placeholder="Nombre de empresa" style="border: 1px solid #eee; border-radius: 0; padding: 12px; font-size: 13px;" required>
                    </div>
                    <div class="mb-4">
                        <input class="form-control" type="text" name="telefono" placeholder="Teléfono" style="border: 1px solid #eee; border-radius: 0; padding: 12px; font-size: 13px;" required>
                    </div>
                    <button type="submit" class="btn_1 w-100" style="background-color: #D48A1F; color: #fff; border: none; padding: 12px; font-family: 'Quicksand', sans-serif; font-size: 14px; font-weight: 600;">
                        ENVIAR INFORMACIÓN
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
