<div>
    <div class="top_panel">
        <div class="container header_panel">
            <a href="#0" class="btn_close_top_panel"><i class="ti-close"></i></a>
            <label><span id="cantidad_added" >1</span> producto agregado al carrito</label>
        </div>
        <!-- /header_panel -->
        <div class="item">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="item_panel">
                            <figure>
                                <img src="{{ $producto->imagen() }}" data-src="{{ $producto->imagen() }}" class="lazy" alt="">
                            </figure>
                            <h4><span id="cantidad_added_prod"></span>x {{ $producto->nombre }}</h4>
                            <div class="price_panel"><span class="new_price">@livewire('precio-component' , [$producto->id] , key('prod-price-added' . md5(time())))</span>
                                @if($producto->antes)
                                    <span class="percentage">-{{ $producto->descuentoPorcentaje() }}%</span> 
                                    <span class="old_price">${{ number_format($producto->antes , 2) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 btn_panel">
                        <a href="{{ route('carrito') }}" class="btn_1 outline">Ver Carrito</a> <a href="{{ route('checkout') }}" class="btn_1">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /item -->
        <div class="container related">
            <h4>También pueden interesarte</h4>
            <div class="row">
                @foreach( $producto->relacionados() as $rel )
                    <div class="col-md-3">
                        <div class="item_panel">
                            <a href="#0">
                                <figure>
                                    <img src="{{ $rel->imagen() }}" alt="" class="lazy">
                                </figure>
                            </a>
                            <a href="#0">
                                <h5>{{ Str::title($rel->nombre) }}</h5>
                            </a>
                            <div class="price_panel"><span class="new_price">${{ number_format($rel->precio , 2) }}</span></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /related -->
    </div>
    <!-- /add_cart_panel -->
   
</div>
