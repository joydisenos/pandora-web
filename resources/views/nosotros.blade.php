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

      <div class="container margin_120_95" style="padding-bottom: 150px;">
          <div class="row align-items-center">
              <div class="col-lg-6 position-relative mb-5 mb-lg-0">
                  <img src="{{ asset('img/nosotros-1.jpg') }}" class="img-fluid" alt="Nosotros" style="width: 80%; border-radius: 8px;">
                  <img src="{{ asset('img/nosotros-2.jpg') }}" class="img-fluid shadow position-absolute" alt="Familia" style="width: 65%; bottom: -80px; right: 0; border: 12px solid #fff; border-radius: 8px;">
              </div>
              <div class="col-lg-6 ps-lg-5">
                  <div class="intro mt-5 mt-lg-0">
                      <h2 class="gilda-font mb-4" style="color: #D48A1F; font-size: 42px;">¿Quienes somos?</h2>
                      <div style="font-family: 'Quicksand', sans-serif; font-size: 15px; color: #555; line-height: 1.8;">
                          <p><strong>PANDORA HOTEL COLLECTION</strong> es una empresa líder en la producción, importación y distribución de textiles de alta calidad para la industria hotelera y del hogar. Con una amplia gama de productos que incluyen almohadas, protectores, sábanas, fundas, edredones, toallas y frazadas, nos especializamos en ofrecer soluciones personalizadas.</p>
                          <p>Nuestro compromiso con la excelencia se refleja en la cuidadosa selección de materiales de primera calidad y en la atención al detalle en la fabricación de cada producto.</p>
                          <p>Con más de 10 años de experiencia en Fabricación, Importación y distribución a nivel nacional, nos enorgullecemos de ofrecer un servicio confiable y eficiente a nuestros clientes.</p>
                          <p class="mb-0">Nuestra empresa se distingue por nuestro compromiso con la satisfacción del cliente, la innovación en diseño y la constante búsqueda de la excelencia en cada aspecto de nuestro negocio.</p>
                      </div>
                      <a href="{{ route('contacto') }}" class="btn_1 mt-5" style="background-color: transparent; border: 2px dashed #D48A1F; color: #D48A1F; font-family: 'Quicksand', sans-serif; font-weight: 600; text-transform: uppercase; padding: 12px 40px; display: inline-block;">
                          CONTACTANOS
                      </a>
                  </div>
              </div>
          </div>
      </div>
      <!-- /container -->

      <!-- Counters Section -->
      <section class="position-relative" style="background: url('{{ asset('img/bn-4.jpg') }}') center center/cover no-repeat; padding: 100px 0;">
          <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.55); z-index: 1;"></div>
          <div class="container position-relative" style="z-index: 2;">
              <div class="row text-center text-white">
                  <div class="col-6 col-md-3 mb-4 mb-md-0">
                      <div class="d-flex justify-content-center align-items-center mb-2">
                          <span style="font-size: 56px; font-weight: 700; font-family: 'Quicksand', sans-serif;">+</span>
                          <span style="font-size: 56px; font-weight: 700; font-family: 'Quicksand', sans-serif;" class="counter-up" data-count="30">0</span>
                      </div>
                      <p style="font-size: 16px; font-family: 'Quicksand', sans-serif; font-weight: 400; margin: 0;">Años de experiencia</p>
                  </div>
                  <div class="col-6 col-md-3 mb-4 mb-md-0">
                      <div class="d-flex justify-content-center align-items-center mb-2">
                          <span style="font-size: 56px; font-weight: 700; font-family: 'Quicksand', sans-serif;">+</span>
                          <span style="font-size: 56px; font-weight: 700; font-family: 'Quicksand', sans-serif;" class="counter-up" data-count="300">0</span>
                      </div>
                      <p style="font-size: 16px; font-family: 'Quicksand', sans-serif; font-weight: 400; margin: 0;">Clientes felices</p>
                  </div>
                  <div class="col-6 col-md-3 mb-4 mb-md-0">
                      <div class="d-flex justify-content-center align-items-center mb-2">
                          <span style="font-size: 56px; font-weight: 700; font-family: 'Quicksand', sans-serif;">+</span>
                          <span style="font-size: 56px; font-weight: 700; font-family: 'Quicksand', sans-serif;" class="counter-up" data-count="100">0</span>
                      </div>
                      <p style="font-size: 16px; font-family: 'Quicksand', sans-serif; font-weight: 400; margin: 0;">Productos de alta calidad</p>
                  </div>
                  <div class="col-6 col-md-3 mb-4 mb-md-0">
                      <div class="d-flex justify-content-center align-items-center mb-2">
                          <span style="font-size: 56px; font-weight: 700; font-family: 'Quicksand', sans-serif;">+</span>
                          <span style="font-size: 56px; font-weight: 700; font-family: 'Quicksand', sans-serif;" class="counter-up" data-count="20">0</span>
                      </div>
                      <p style="font-size: 16px; font-family: 'Quicksand', sans-serif; font-weight: 400; margin: 0;">Centros de distribución</p>
                  </div>
              </div>
          </div>
      </section>

      <!-- Misión, Visión, Valores Section -->
      <section style="padding: 80px 0; background-color: #fff;">
          <div class="container">
              <div class="row">
                  <!-- Misión -->
                  <div class="col-md-4 mb-5 mb-md-0">
                      <div class="position-relative d-flex flex-column align-items-center">
                          <img src="{{ asset('img/mision.jpg') }}" alt="Misión" class="img-fluid shadow-sm" style="border-radius: 8px; width: 100%; height: 260px; object-fit: cover;">
                          <div class="bg-white text-center shadow" style="border-radius: 8px; width: 85%; padding: 15px; margin-top: -25px; position: relative; z-index: 10;">
                              <h5 class="mb-0" style="font-family: 'Quicksand', sans-serif; font-size: 18px; color: #333; font-weight: 500;">
                                  <i class="far fa-compass me-2"></i> Misión
                              </h5>
                          </div>
                      </div>
                      <div class="mt-4 px-2" style="font-family: 'Quicksand', sans-serif; font-size: 13px; color: #555; line-height: 1.7; text-align: justify;">
                          <p>Nuestra misión en <strong>PANDORA HOTEL COLLECTION</strong> es proporcionar textiles de la más alta calidad que superen las expectativas de nuestros clientes. Estamos comprometidos a ser líderes en la innovación, la excelencia en la fabricación y la atención al cliente, ofreciendo soluciones personalizadas que reflejen nuestra esencia y nuestro estilo.</p>
                          <p>Buscamos constantemente la perfección en nuestros productos, seleccionando cuidadosamente los materiales y procesos de fabricación para garantizar la durabilidad, comodidad y elegancia en cada artículo que producimos. Nuestro objetivo es no solo satisfacer, sino superar las necesidades y deseos de nuestros clientes, brindando un servicio confiable y eficiente que genere confianza y fidelidad a largo plazo.</p>
                      </div>
                  </div>

                  <!-- Visión -->
                  <div class="col-md-4 mb-5 mb-md-0">
                      <div class="position-relative d-flex flex-column align-items-center">
                          <img src="{{ asset('img/vision.jpg') }}" alt="Visión" class="img-fluid shadow-sm" style="border-radius: 8px; width: 100%; height: 260px; object-fit: cover;">
                          <div class="bg-white text-center shadow" style="border-radius: 8px; width: 85%; padding: 15px; margin-top: -25px; position: relative; z-index: 10;">
                              <h5 class="mb-0" style="font-family: 'Quicksand', sans-serif; font-size: 18px; color: #333; font-weight: 500;">
                                  <i class="far fa-eye me-2"></i> Visión
                              </h5>
                          </div>
                      </div>
                      <div class="mt-4 px-2" style="font-family: 'Quicksand', sans-serif; font-size: 13px; color: #555; line-height: 1.7; text-align: justify;">
                          <p>En <strong>PANDORA HOTEL COLLECTION</strong>, nuestra visión es ser reconocidos como la opción preferida a nivel mundial en la provisión de textiles de cama para la industria hotelera y del hogar. Nos esforzamos por ser líderes en innovación y calidad, trabajando en estrecha colaboración con nuestros clientes para anticipar y satisfacer sus necesidades cambiantes.</p>
                          <p>Buscamos expandir nuestra presencia global, estableciendo relaciones duraderas. Nuestra visión incluye el crecimiento sostenible, la diversificación de nuestra oferta de productos y la adaptación continua a las tendencias y demandas del mercado.</p>
                          <p>Buscamos ser un modelo a seguir en términos de prácticas comerciales éticas e impacto ambiental positivo.</p>
                      </div>
                  </div>

                  <!-- Valores -->
                  <div class="col-md-4 mb-5 mb-md-0">
                      <div class="position-relative d-flex flex-column align-items-center">
                          <img src="{{ asset('img/valores.jpg') }}" alt="Valores" class="img-fluid shadow-sm" style="border-radius: 8px; width: 100%; height: 260px; object-fit: cover;">
                          <div class="bg-white text-center shadow" style="border-radius: 8px; width: 85%; padding: 15px; margin-top: -25px; position: relative; z-index: 10;">
                              <h5 class="mb-0" style="font-family: 'Quicksand', sans-serif; font-size: 18px; color: #333; font-weight: 500;">
                                  <i class="far fa-heart me-2"></i> Valores
                              </h5>
                          </div>
                      </div>
                      <div class="mt-4 px-2" style="font-family: 'Quicksand', sans-serif; font-size: 13px; color: #555; line-height: 1.7; text-align: justify;">
                          <p>Actuamos con honestidad, ética y transparencia en todas nuestras interacciones comerciales, manteniendo altos estándares de integridad y responsabilidad.</p>
                          <p>Nuestros clientes son nuestra prioridad, por lo que nos esforzamos por ofrecer un servicio excepcional, soluciones personalizadas y una atención al cliente proactiva y receptiva.</p>
                          <p>Valoramos las asociaciones sólidas y positivas tanto dentro de nuestra empresa como con nuestros proveedores, clientes y comunidades, fomentando un espíritu de colaboración y trabajo en equipo.</p>
                      </div>
                  </div>
              </div>
          </div>
      </section>

@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const counters = document.querySelectorAll('.counter-up');
        const speed = 100; // La velocidad de la animación
        
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    const counter = entry.target;
                    const updateCount = () => {
                        const target = +counter.getAttribute('data-count');
                        const count = +counter.innerText;
                        const inc = target / speed;
                        
                        if (count < target) {
                            counter.innerText = Math.ceil(count + inc);
                            setTimeout(updateCount, 30);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    updateCount();
                    observer.unobserve(counter);
                }
            });
        }, { threshold: 0.5 });
        
        counters.forEach(counter => {
            observer.observe(counter);
        });
    });
</script>
@endsection