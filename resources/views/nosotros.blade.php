@extends('layouts.principal')
@section('content')
<div class="hero small-height jarallax" data-jarallax data-speed="0.2">
          <img class="jarallax-img" src="{{ asset('assets/img/cama.webp') }}" alt="">
          <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
              <div class="container">
                  <small class="slide-animated one">Riviera Finelinens</small>
                  <h1 class="slide-animated two">Nosotros</h1>
              </div>
          </div>
      </div>
      <!-- /Background Img Parallax -->

      <div class="container margin_120_95">
          <div class="row justify-content-between align-items-top">
              <div class="col-lg-5">
                  <div class="parallax_wrapper inverted">
                      <img src="{{ asset('assets/img/salto_cama.webp') }}" alt="" class="img-fluid rounded-img">
                      <div data-cue="slideInUp" class="img_over"><span data-jarallax-element="-30"><img src="{{ asset('assets/img/waldof.png') }}" alt="" class="rounded-img"></span></div>
                  </div>
              </div>
              <div class="col-lg-5">
                  <div class="intro">
                      <div class="title">
                          <small>Pandora</small>
                          <h2>Sobre Nosotros</h2>
                      </div>
                      <p class="lead">{!! nl2br(opcionSlug('nosotros_texto_seccion')) !!}</p>
                      <!-- <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. </p>
                      <p>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo.</p>
                      <p><em>Maria...the Owner</em></p> -->
                  </div>
              </div>
          </div>
          <!-- /Row -->
      </div>
      <!-- /container -->

@endsection