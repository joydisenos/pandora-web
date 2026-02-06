@extends('layouts.principal')
@section('content')
<!-- Breadcromb Area Start -->
<section class="gauto-breadcromb-area section_70">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="breadcromb-box">
                <h3>Servicios</h3>
                <ul>
                   <li><i class="fa fa-home"></i></li>
                   <li><a href="{{ route('home') }}">Home</a></li>
                   <li><i class="fa fa-angle-right"></i></li>
                   <li>Servicios</li>
                </ul>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!-- Breadcromb Area End -->
  
  
 <!-- Service Area Start -->
 <section class="gauto-service-area service-page-area section_70">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="site-heading">
                <h4>see our</h4>
                <h2>Latest Services</h2>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-4">
             <div class="single-service">
                <span class="service-number">01 </span>
                <div class="service-icon">
                   <img src="assets/img/city-transport.png" alt="city trasport" />
                </div>
                <div class="service-text">
                   <a href="#">
                      <h3>Alquiler Autos</h3>
                   </a>
                   <p>Risus commodo maecenas accumsan lacus vel facilisis. Lorem ipsum dolor consectetur adipiscing elit.</p>
                </div>
             </div>
          </div>
          <div class="col-md-4">
             <div class="single-service">
                <span class="service-number">02 </span>
                <div class="service-icon">
                   <img src="assets/img/airport-transport.png" alt="airport trasport" />
                </div>
                <div class="service-text">
                   <a href="#">
                      <h3>Compra y Venta de Autos</h3>
                   </a>
                   <p>Risus commodo maecenas accumsan lacus vel facilisis. Lorem ipsum dolor consectetur adipiscing elit.</p>
                </div>
             </div>
          </div>
          <div class="col-md-4">
             <div class="single-service">
                <span class="service-number">03 </span>
                <div class="service-icon">
                   <img src="assets/img/hospital-transport.png" alt="hospital trasport" />
                </div>
                <div class="service-text">
                   <a href="#">
                      <h3>Financiamiento</h3>
                   </a>
                   <p>Risus commodo maecenas accumsan lacus vel facilisis. Lorem ipsum dolor consectetur adipiscing elit.</p>
                </div>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-4">
             <div class="single-service">
                <span class="service-number">04 </span>
                <div class="service-icon">
                   <img src="assets/img/wedding-ceremony.png" alt="wedding trasport" />
                </div>
                <div class="service-text">
                   <a href="#">
                      <h3>Seguros</h3>
                   </a>
                   <p>Risus commodo maecenas accumsan lacus vel facilisis. Lorem ipsum dolor consectetur adipiscing elit.</p>
                </div>
             </div>
          </div>
          <div class="col-md-4">
             <div class="single-service">
                <span class="service-number">05 </span>
                <div class="service-icon">
                   <img src="assets/img/hotel-transport.png" alt="wedding trasport" />
                </div>
                <div class="service-text">
                   <a href="#">
                      <h3>Whole City Tour</h3>
                   </a>
                   <p>Risus commodo maecenas accumsan lacus vel facilisis. Lorem ipsum dolor consectetur adipiscing elit.</p>
                </div>
             </div>
          </div>
          <div class="col-md-4">
             <div class="single-service">
                <span class="service-number">06 </span>
                <div class="service-icon">
                   <img src="assets/img/luggege-transport.png" alt="wedding trasport" />
                </div>
                <div class="service-text">
                   <a href="#">
                      <h3>Baggage transport</h3>
                   </a>
                   <p>Risus commodo maecenas accumsan lacus vel facilisis. Lorem ipsum dolor consectetur adipiscing elit.</p>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!-- Service Area End -->
@endsection