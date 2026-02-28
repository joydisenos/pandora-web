
<div>
    <section class="product-detail py-5">
        <div class="container">
            <div class="row">
                <!-- Imágenes del producto -->
                <div class="col-md-6">
                    <div class="product-images">
                        <img src="{{ $producto->imagen() }}" class="img-fluid rounded mb-3" alt="Producto principal" id="mainImage">
                        <div class="thumbnail-gallery d-flex flex-wrap gap-2">

                            <img src="{{ $producto->imagen() }}" class="img-thumbnail" alt="Miniatura 1" onclick="changeImage(this.src)">
                            @foreach($producto->galeria as $gal)
                                <img src="{{ $gal->imagen() }}" class="img-thumbnail" alt="Miniatura {{ $loop->index + 2 }}" onclick="changeImage(this.src)">
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Información del producto -->
                <div class="col-md-6">
                    <div class="product-info">
                        <h1 class="product-title h2 mb-3">{{ $producto->nombre }}</h1>
                        
                        @if($producto->precio > 0)
                            <div class="product-price mb-3">
                                <span class="h4 text-primary">${{ $producto->precio }}</span>
                                @if($producto->antes)
                                    <span class="text-muted text-decoration-line-through ms-2">${{ $producto->antes }}</span>
                                    <!-- <span class="percentage">-{{ $producto->descuentoPorcentaje() }}%</span> <span class="old_price">${{ number_format($producto->antes , 2) }}</span> -->
                                    <span class="badge bg-danger ms-2">-{{ $producto->descuentoPorcentaje() }}%</span>
                                @endif
                            </div>
                        @endif

                        <!-- <div class="product-rating mb-3">
                            <div class="stars">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="far fa-star text-warning"></i>
                                <span class="ms-2 text-muted">(4.0)</span>
                            </div>
                        </div> -->

                        <div class="product-description mb-4">
                            <p class="text-muted">
                                {!! nl2br($producto->descripcion) !!}
                            </p>
                        </div>

                        <!-- sub productos -->
                        @if($subproductos->count())
                            <div class="mb-4">
                                <label class="form-label">Opciones:</label>
                                <select class="form-control" id="subProductSelect" onchange="updateProductSelection(this)">
                                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                    @foreach($subproductos as $sub)
                                        <option value="{{ $sub->id }}" data-price="{{ $sub->precio }}">{{ $sub->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <script>
                                function updateProductSelection(select) {
                                    var selectedOption = select.options[select.selectedIndex];
                                    var productId = selectedOption.value;
                                    var productPrice = selectedOption.dataset.price;
                                    
                                    var btn = document.querySelector('.agregar-carrito-detalle');
                                    if(btn) {
                                        btn.setAttribute('data-id', productId);
                                        if(productPrice > 0) {
                                            // solo habilita si es mayor a 0
                                            btn.removeAttribute('disabled'); // Habilita el botón
                                            btn.classList.remove('disabled'); // Remueve clase CSS si existe
                                            btn.disabled = false; // Alternativa para habilitar
                                        } else {
                                            // Opcional: deshabilitar si el precio es 0 o negativo
                                            btn.setAttribute('disabled', 'disabled');
                                            btn.classList.add('disabled');
                                            btn.disabled = true;
                                        }
                                    }
                                    var price = document.querySelector('.precio-pri');
                                    if(price) {
                                        price.textContent = '$' + productPrice;
                                    }
                                }
                            </script>
                        @endif

                        @if(count($tallas))
                            <div class="mb-4">
                                @foreach($tallas as $tallaList)
                                    <span class="btn_1 mb-4 {{ $tallaSeleccionada == $tallaList ? 'bg-blue-pri' : '' }}" wire:click.prevent="selectTalla('{{ $tallaList }}')">{{ $tallaList }}</span>
                                @endforeach
                            </div>
                            <script>
                                // function updateProductSelection(select) {
                                //     var selectedOption = select.options[select.selectedIndex];
                                //     var productId = selectedOption.value;
                                //     var btn = document.querySelector('.agregar-carrito-detalle');
                                //     if(btn) {
                                //         btn.setAttribute('data-id', productId);
                                //     }
                                // }
                            </script>
                        @endif

                        @if(count($colores))
                            <div class="mb-4">
                                @foreach($colores as $colorList)
                                    <span class="btn_1 mb-4 {{ $colorSeleccionado == $colorList ? 'bg-blue-pri' : '' }}" wire:click.prevent="selectColor('{{ $colorList }}')">{{ $colorList }}</span>
                                @endforeach
                            </div>
                        @endif

                        <div class="product-quantity mb-4">
                            <label class="form-label">Cantidad:</label>
                            <div class="input-group" style="width: 150px;">
                                <!-- <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">-</button> -->
                                <input type="number" class="form-control text-center" min="1" value="1" id="quantityInput">
                                <!-- <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">+</button> -->
                            </div>
                        </div>

                        <div class="product-actions mb-4">
                            <button class="btn-pri-claro me-2 agregar-carrito-detalle" data-id="{{ $producto->id }}" {{ $producto->precio <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-shopping-cart mr-2"></i>Agregar al Carrito
                            </button>
                            <!-- <button class="btn btn-outline-secondary btn-lg">
                                <i class="far fa-heart me-2"></i>Favoritos
                            </button> -->
                        </div>

                        <div class="producto-price">
                            <h2 class="precio-pri">{{ $producto->precio ? '$' . $producto->precio : '' }}</h2>
                        </div>
<!-- 
                        <div class="product-meta">
                            <div class="d-flex flex-wrap gap-3 text-muted small">
                                <span><i class="fas fa-truck me-1"></i> Envío gratis</span>
                                <span><i class="fas fa-undo me-1"></i> Devolución en 30 días</span>
                                <span><i class="fas fa-shield-alt me-1"></i> Garantía 1 año</span>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>

            <!-- Tabs de información adicional -->
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="">
                        <h5>SKU</h5>
                        <p class="text-muted">
                            {{ $producto->sku_producto }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <h5>Marca</h5>
                        <p class="text-muted">
                            {{ $producto->marca }}
                        </p>
                    </div>
                </div>
                <div class="col-12">
                    <div class=" rounded-bottom">
                        @if($producto->detalles)
                            <div class="" id="description" role="tabpanel">
                                <h3>Detalles</h3>
                                <div>{!! nl2br($producto->detalles) !!}</div>
                            </div>
                        @endif
                        @if($producto->galeria->count())
                            <div class="" id="specs" role="tabpanel">
                                <h3>Galeria</h3>
                                <div class="row">
                                    @foreach($producto->galeria as $gal)
                                        <div class="col-md-4 mb-3">
                                            <img src="{{ $gal->imagen() }}" class="img-fluid rounded" alt="Imagen de galería {{ $loop->index + 1 }}">
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        @endif
                        <!-- <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <p>Reseñas de clientes aparecerán aquí.</p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>