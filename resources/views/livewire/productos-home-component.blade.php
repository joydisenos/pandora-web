<div>
    <section class="ftco-section">
        <div class="container">
             <div class="row justify-content-center mb-3 pb-3">
           <div class="col-md-12 heading-section text-center ftco-animate">
              <span class="subheading">Últimos productos publicados</span>
             <h2 class="mb-4">Nuestros Productos</h2>
             {{-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> --}}
           </div>
         </div>   		
        </div>
        <div class="container">
           <div class="row">
               @foreach(productosPublicos() as $producto)
                  <div class="col-md-6 col-lg-3 ftco-animate">
                     <div class="product">
                        <a href="{{ route('producto' , Hashid::encode($producto->id)) }}" class="img-prod"><img class="img-fluid" src="{{ $producto->imagen() }}" alt="Colorlib Template">
                           {{-- <span class="status">30%</span> --}}
                           <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                           <h3><a href="#">{{ $producto->nombre }}</a></h3>
                           <div class="d-flex">
                              <div class="pricing">
                                 <p class="price">
                                    {{-- <span class="mr-2 price-dc">$120.00</span> --}}
                                    <span class="price-sale">${{ number_format($producto->precio , 2 , ',' , '.')}}</span></p>
                              </div>
                           </div>
                           <div class="bottom-area d-flex px-3">
                              <div class="m-auto d-flex">
                                 {{-- <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                 </a> --}}
                                 <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                    <span><i class="ion-ios-cart" wire:click.prevent="$emit('addProducto' , {{ $producto->id }})"></i></span>
                                 </a>
                                 {{-- <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                    <span><i class="ion-ios-heart"></i></span>
                                 </a> --}}
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
           </div>
        </div>
      </section> 
</div>
