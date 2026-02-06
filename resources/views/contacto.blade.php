@extends('layouts.principal')
@section('content')
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

        <div class="container margin_120_95">
            <div class="row justify-content-between">
                <div class="col-xl-4 col-lg-5 order-lg-2">
                    <div class="contact_info">
                        <ul class="clearfix">
                            <li>
                                <i class="bi bi-geo-alt"></i>
                                <h4>Dirección</h4>
                                <div>{{ opcionSlug('direccion') }}</div>
                            </li>
                            <li>
                                <i class="bi bi-envelope-paper"></i>
                                <h4>Email</h4>
                                <p><a href="#0">{{ opcionSlug('email_contacto') }}</a></p>
                            </li>
                            <li>
                                <i class="bi bi-telephone"></i>
                                <h4>Teléfono</h4>
                                <div>{{ opcionSlug('telefono_contacto') }}</div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 order-lg-1">
                    <h3 class="mb-3">Contáctanos</h3>
                    <div id="message-contact"></div>
                    <form method="post" action="phpmailer/contact_template_email.php" id="contactform" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" id="name_contact" name="name_contact" placeholder="Nombre">
                                    <label for="name_contact">Nombre</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" id="lastname_contact" name="lastname_contact" placeholder="Apellido">
                                    <label for="lastname_contact">Apellido</label>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="email" id="email_contact" name="email_contact" placeholder="Email">
                                    <label for="email_contact">Email</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" id="phone_contact" name="phone_contact" placeholder="Teléfono">
                                    <label for="phone_contact">Teléfono</label>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="form-floating mb-4">
                            <textarea class="form-control" placeholder="Mensaje" id="message_contact" name="message_contact"></textarea>
                            <label for="message_contact">Mensaje</label>
                        </div>
                        <p class="mt-3"><input type="submit" value="Enviar" class="btn_1 outline" id="submit-contact"></p>
                    </form>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!--/container -->

        <div class="map_contact">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3021.4364241114604!2d-73.96780638459853!3d40.774418641731515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258a29d3847f5%3A0x564dfbba0141774a!2s5th%20Ave%2C%20New%20York%2C%20NY%2C%20Stati%20Uniti!5e0!3m2!1sit!2ses!4v1661414716655!5m2!1sit!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!--/map_contact -->

@endsection
@section('scripts')
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
  function onSubmit(token) {
    Livewire.emit('enviarContacto' , token);
  }
</script>
@endsection
