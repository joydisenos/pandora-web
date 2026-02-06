<div class="frame-producto">
    <img src="{{ $producto->imagen() }}" alt="" class="img-prod-principal">
    <div class="descripcion-prod">
        <!-- <h5 class="text-black text-center my-2">
            {{ $producto->nombre }}
        </h5> -->
        <h5 class="text-primary small mb-2">
            {{ $producto->descripcion }}
        </h5>
    </div>
    <div class="">
        
        <h5 class="text-black text-center my-2">
            {{ $producto->nombre }}
        </h5>
        <h5 class="text-primary small mb-2">
            ${{ $producto->precio }}
        </h5>
        
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('producto' , Hashid::encode($producto->id)) }}" class="btn_1 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye mr-2" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                </svg>
                <span> &nbsp; Ver</span>
            </a>
            
            <a href="{{ route('producto' , Hashid::encode($producto->id)) }}" class="btn_1 mb-4 agregar-carrito" data-id="{{ $producto->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-cart-plus mr-2" viewBox="0 0 16 16">
                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
                <span> &nbsp; Agregar</span>
            </a>
        </div>
        
    </div>
</div>