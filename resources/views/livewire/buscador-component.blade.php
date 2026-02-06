<div class="container">
    @if($buscar)
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="list-group list-group-flush">
                    
                    @if(count($categorias))
                        <a href="#" wire:click.prevent class="list-group-item list-group-item-action bg-secondary text-white text-center">
                            <strong>Categorías</strong>
                        </a>
                    @endif

                    @foreach($categorias as $categoria)
                        <a href="{{ route('tienda' , ['categoriaId' => $categoria->id]) }}" class="list-group-item list-group-item-action">
                            {{ $categoria->nombre }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-4 my-4">
                        <h6>Búsqueda: {{ $buscar }}</h6>
                    </div>
                    <div class="col-4 my-4 text-center">
                        <h6>Resultados: {{ $productos->total() }}</h6>
                    </div>
                    <div class="col-4 my-4">
                        {{ $productos->links() }}
                    </div>
                    @foreach($productos as $producto)
                        <div class="col-6 col-md-3 isotope-item sale">
                            <div class="grid_item">
                            <figure>
                                @if($producto->antes)
                                <span class="ribbon off">-{{ $producto->descuentoPorcentaje() }}%</span>
                                @endif
                                <a href="{{route('producto' , Hashid::encode($producto->id) )}}">
                                <img class="img-fluid lazy" src="{{ $producto->imagen() }}" data-src="{{ $producto->imagen() }}" alt="">
                                <img class="img-fluid lazy" src="{{ $producto->imagen() }}" data-src="{{ $producto->imagen() }}" alt="">
                                </a>
                                {{-- <div data-countdown="2019/05/15" class="countdown"></div> --}}
                            </figure>
                            
                            <div class="rating">
                                <i class="icon-star {{ $producto->comentariosPromedio()  >= 1 ? 'voted' : ''}} "></i>
                                <i class="icon-star {{ $producto->comentariosPromedio()  >= 2 ? 'voted' : ''}}"></i>
                                <i class="icon-star {{ $producto->comentariosPromedio()  >= 3 ? 'voted' : ''}}"></i>
                                <i class="icon-star {{ $producto->comentariosPromedio()  >= 4 ? 'voted' : ''}}"></i>
                                <i class="icon-star {{ $producto->comentariosPromedio()  >= 5 ? 'voted' : ''}}"></i>
                            </div>

                            @if($producto->variantes()->count())
                                <div class="variantes-container">
                                @include('includes.arrows')
                                <div class="slide-variantes">

                                    @foreach($producto->variantes() as $var)
                                    @if($var->disponible())
                                        <img src="{{ $var->imagen() }}" alt="" class="agregar-prod" data-id-prod="{{ $var->id }}" width="60px" class="mr-2">
                                    @endif
                                    @endforeach
                                </div>
                                </div>
                            @endif
                
                            <a href="{{route('producto' , Hashid::encode($producto->id) )}}">
                                <h3>{{ $producto->nombre }}</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">${{ number_format($producto->precio , 2) }}</span>
                                @if($producto->antes)
                                <span class="old_price">${{ number_format($producto->antes , 2) }}</span>
                                @endif
                            </div>
                            <ul>
                                {{-- <li><a href="#0" class="tooltip-1 agregar-fav" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to favorites" data-id-prod="{{ $producto->id }}"><i class="ti-heart"></i><span>Add to favorites</span></a></li> --}}
                                {{-- <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li> --}}
                                {{-- <li><a href="#0" class="tooltip-1 agregar-prod" data-id-prod="{{ $producto->id }}" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li> --}}
                            </ul>
                            </div>
                            <!-- /grid_item -->
                        </div>
                        <!-- /col -->
                    @endforeach
                </div>
            </div>
            
        </div>
    @endif
</div>
