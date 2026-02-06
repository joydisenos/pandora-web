<div>
    <!-- Service Details Page Start -->
    <div class="container margin_30">
        <div class="page_header">
           <div class="breadcrumbs">
              <ul>
                 <li><a href="{{ route('home') }}">Inicio</a></li>
                 {{-- <li><a href="#">Category</a></li> --}}
                 <li>Favoritos</li>
              </ul>
        </div>
        <h1>Favoritos</h1>
     </div>
    <div class="container margin_30">
        <div class="row small-gutters">
            @foreach($favoritos as $fav)
                <div class="col-6 col-md-4 col-xl-3 isotope-item sale">
                    <div class="grid_item">
                    <figure>
                        <a href="{{route('producto' , Hashid::encode($fav->producto_id) )}}">
                        <img class="img-fluid lazy" src="{{ $fav->imagen }}" data-src="{{ $fav->imagen }}" alt="">
                        <img class="img-fluid lazy" src="{{ $fav->imagen }}" data-src="{{ $fav->imagen }}" alt="">
                        </a>
                    </figure>
                    <a href="{{route('producto' , Hashid::encode($fav->producto_id) )}}">
                        <h3>{{ $fav->nombre }}</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">${{ number_format($fav->precio , 2) }}</span>
                    </div>
                    <ul>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to favorites" wire:click.prevent="delete({{ $fav->id }})"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        {{-- <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li> --}}
                        {{-- <li><a href="#0" wire:click.prevent="$emit('addfav' , {{ $fav->id }})" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li> --}}
                    </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /col -->
            @endforeach			
        </div>
        <!-- /row -->
    </div>

    <div class="d-flex justify-content-center">
        {{ $favoritos->links() }}
    </div>
</div>
