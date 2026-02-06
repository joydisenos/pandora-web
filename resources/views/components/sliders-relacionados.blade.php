@foreach($productos as $rel)
    <div class="item">
        <div class="grid_item">
            {{-- <span class="ribbon new">New</span> --}}
            @if($rel->antes)
                <span class="ribbon off">-{{ $rel->descuentoPorcentaje() }}%</span>
            @endif
            <figure>
                <a href="{{route('producto' , Hashid::encode($rel->id) )}}">
                    <img class="owl-lazy" src="{{ $rel->imagen() }}" data-src="{{ $rel->imagen() }}" alt="">
                </a>
            </figure>
            <div class="rating">
                <i class="icon-star {{ $rel->comentariosPromedio()  >= 1 ? 'voted' : ''}} "></i>
                <i class="icon-star {{ $rel->comentariosPromedio()  >= 2 ? 'voted' : ''}}"></i>
                <i class="icon-star {{ $rel->comentariosPromedio()  >= 3 ? 'voted' : ''}}"></i>
                <i class="icon-star {{ $rel->comentariosPromedio()  >= 4 ? 'voted' : ''}}"></i>
                <i class="icon-star {{ $rel->comentariosPromedio()  >= 5 ? 'voted' : ''}}"></i>
            </div>

            @if($rel->variantes()->count())
                <div class="variantes-container">
                  @include('includes.arrows')
                  <div class="slide-variantes">

                    @foreach($rel->variantes() as $var)
                      @if($var->disponible())
                        <img src="{{ $var->imagen() }}" alt="" class="agregar-prod" data-id-prod="{{ $var->id }}" width="60px" class="mr-2">
                      @endif
                    @endforeach
                  </div>
                </div>
              @endif

            <a href="{{route('producto' , Hashid::encode($rel->id) )}}">
                <h3>{{ $rel->nombre }}</h3>
            </a>
            <div class="price_box">
                <span class="new_price">${{ number_format($rel->precio , 2) }}</span>
                @if($rel->antes)
                <span class="old_price">${{ number_format($rel->antes , 2) }}</span>
                @endif
            </div>
            <ul>
                <li><a href="#0" class="tooltip-1 agregar-fav" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to favorites" data-id-prod="{{ $rel->id }}"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                {{-- <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li> --}}
                {{-- temporalmente desactivado --}}
                @if($rel->esIndependiente())
                    <li><a href="#0" class="tooltip-1 agregar-prod" data-id-prod="{{ $rel->id }}" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                @endif
            </ul>
        </div>
        <!-- /grid_item -->
    </div>
    <!-- /item -->
@endforeach