@extends('layouts.principal')
@section('content')
<style>
    /* Styling for the new contact section */
    .contact-top-section {
        background-color: #fff;
        padding: 60px 0;
    }
    .contact-item {
        text-align: center;
        padding: 20px;
    }
    .contact-item i {
        font-size: 30px;
        color: #333;
        margin-bottom: 15px;
        display: block;
    }
    .contact-item h4 {
        color: #D48A1F;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        text-transform: none;
    }
    .contact-item p {
        color: #555;
        font-size: 14px;
        margin: 0;
    }
    .contact-item a {
        color: #555;
    }
    .wavy-divider {
        width: 100%;
        overflow: hidden;
        line-height: 0;
        margin-top: -5px;
        background-color: #fff;
    }
    .wavy-divider svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 40px;
    }
    .wavy-divider .shape-fill {
        fill: #f5f4ef;
    }
    .contact-bottom-section {
        background-color: #f5f4ef;
        padding: 40px 0 80px 0;
        text-align: center;
    }
    .contact-bottom-section .small-title {
        font-size: 12px;
        letter-spacing: 2px;
        color: #666;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    .contact-bottom-section h2 {
        color: #D48A1F;
        font-size: 32px;
        margin-bottom: 15px;
        font-weight: 600;
    }
    .contact-bottom-section .subtitle {
        color: #555;
        font-size: 14px;
        margin-bottom: 40px;
    }
    .custom-form-contact {
        max-width: 700px;
        margin: 0 auto;
        text-align: left;
    }
    .custom-form-contact .form-control {
        background-color: #fff;
        border: none;
        border-radius: 4px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }
    .custom-form-contact .form-control::placeholder {
        color: #999;
        font-size: 14px;
    }
    .custom-form-contact textarea.form-control {
        height: 150px;
        resize: none;
    }
    .btn-enviar-custom {
        background-color: #D48A1F;
        color: #fff;
        border: none;
        padding: 12px 30px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-enviar-custom:hover {
        background-color: #b57316;
        color: #fff;
    }
</style>

<div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset('assets/img/actualidad_riviera_blog.webp') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Pandora</small>
            <h1 class="slide-animated two">Contacto</h1>
        </div>
    </div>
</div>
<!-- /Background Img Parallax -->

<!-- Top Section: Contact Info -->
<div class="contact-top-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="contact-item">
                    <i class="bi bi-envelope"></i>
                    <h4>Email</h4>
                    <p><a href="mailto:{{ opcionSlug('email_contacto') }}">{{ opcionSlug('email_contacto') }}</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-item">
                    <i class="bi bi-geo-alt"></i>
                    <h4>Dirección</h4>
                    <p>{{ opcionSlug('direccion') }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-item">
                    <i class="bi bi-telephone"></i>
                    <h4>Teléfonos</h4>
                    <p>{!! nl2br(e(opcionSlug('telefono_contacto'))) !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Wavy Divider -->
<div class="wavy-divider">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,111.47,192.39,94.2,236.84,81.79,279.14,70.18,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>

<!-- Bottom Section: Form -->
<div class="contact-bottom-section">
    <div class="container">
        <div class="small-title">CONTÁCTANOS</div>
        <h2>Envíanos un mensaje</h2>
        <p class="subtitle">Uno de nuestros ejecutivos te ayudará a solucionar tus dudas o comentarios de inmediato.</p>

        @livewire('contacto-form-component')

    </div>
</div>

@endsection

@section('scripts')
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
  function onSubmit(token) {
    Livewire.emit('enviarContacto' , token);
  }
</script>
@endsection
