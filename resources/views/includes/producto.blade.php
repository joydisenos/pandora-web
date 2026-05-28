<div class="frame-producto h-100 d-flex flex-column" data-product-id="{{ $producto->id }}">
    
    <div class="flip-card">
        <div class="flip-card-inner">
            <!-- FRENTE -->
            <div class="flip-card-front">
                <img src="{{ $producto->imagen() }}" alt="{{ $producto->nombre }}" class="img-prod-principal" style="width:100%; height:100%; object-fit:cover;">
            </div>
            
            <!-- REVERSO -->
            <div class="flip-card-back">
                <h5 class="text-black mb-3">{{ $producto->nombre }}</h5>
                <p class="small mb-3 text-muted" style="max-height: 80px; overflow: hidden; text-overflow: ellipsis;">
                    {{ Str::limit($producto->descripcion, 90) }}
                </p>
                <a href="{{ route('producto' , Hashid::encode($producto->id)) }}" class="btn_1" style="background-color: #d48a1f; color: white; border: none; padding: 8px 15px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye mr-2" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                    </svg>
                    <span>Ver detalles</span>
                </a>
            </div>
        </div>
    </div>
    
    <div class="d-flex flex-column flex-grow-1">
        
        <h5 class="text-black text-center my-2">
            {{ $producto->nombre }}
        </h5>
        <h5 class="text-primary small mb-2 size-price text-center">
            @if($producto->antes)
                <span class="precio-antes">${{ $producto->antes }}</span>
            @endif
            ${{ $producto->precio() }}
        </h5>
        
        @php 
            $tallas = $producto->variantesFiltros('talla')->pluck('talla')->filter();
            $colores = $producto->variantesFiltros('color')->pluck('color')->filter();
            $hasVariants = $tallas->count() > 0 || $colores->count() > 0;
            $reqTalla = $tallas->count() > 0 ? 'true' : 'false';
            $reqColor = $colores->count() > 0 ? 'true' : 'false';
        @endphp

        <!-- Variantes (Talla y Color) -->
        <div class="variants-container text-center mb-2 px-2" data-req-talla="{{ $reqTalla }}" data-req-color="{{ $reqColor }}">
            @if($tallas->count())
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-1">
                    <span class="small fw-bold me-2">Talla:</span>
                    @foreach($tallas as $t)
                        <span class="variant-square v-talla" data-val="{{ $t }}" onclick="selectVariantCard(this, 'talla')">{{ $t }}</span>
                    @endforeach
                </div>
            @endif

            @if($colores->count())
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-1">
                    <span class="small fw-bold me-2">Color:</span>
                    @foreach($colores as $c)
                        <span class="variant-square v-color" data-val="{{ $c }}" onclick="selectVariantCard(this, 'color')">{{ $c }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center gap-2 mt-auto">
            <input type="number" class="cantidad-carrito" min="1" value="1" style="width: 50px; height: 40px; margin-bottom: 0; padding: 0 5px; text-align: center;">
            
            <a href="#" class="btn_1 agregar-carrito d-flex flex-grow-1 justify-content-center align-items-center {{ $hasVariants ? 'btn-add-disabled' : '' }}" 
               data-id="{{ $producto->id }}" 
               data-talla="" 
               data-color=""
               style="height: 40px; padding: 0 5px; margin-bottom: 0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
                <span class="text-nowrap" style="margin-left: 5px; font-size: 11px; font-weight: 600;">Añadir al carrito</span>
            </a>
            
            <a href="#" class="btn_1 agregar-favorito d-flex justify-content-center align-items-center" data-id="{{ $producto->id }}" style="height: 40px; padding: 0 15px; margin-bottom: 0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                </svg>
            </a>
        </div>
        
    </div>
</div>