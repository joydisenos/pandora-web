<div>
    <div class="container my-5 container pt-1">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4">Carrito de Compras</h3>
            </div>
        </div>

        @if(Cart::isEmpty())
            <!-- Carrito vacío -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body empty-cart text-center py-5">
                            <i class="bi bi-cart-x display-1 text-muted"></i>
                            <h3 class="mb-3 mt-3">Tu carrito está vacío</h3>
                            <p class="text-muted mb-4">Parece que aún no has agregado productos a tu carrito.</p>
                            <a href="{{ route('tienda') }}" class="btn text-white fw-bold"
                                style="background-color: #D48A1F; padding: 0.8rem 2rem;">Comenzar a Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Carrito con productos -->
            <div class="row">
                <!-- Lista de productos -->
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4" style="border: 1px solid #e0e0e0; border-radius: 0;">
                        <div class="card-body" style="padding: 2rem;">
                            <!-- Header -->
                            <div class="row d-none d-md-flex text-center mb-3 fw-bold" style="font-size: 0.9rem;">
                                <div class="col-md-5 text-start">Product</div>
                                <div class="col-md-2">Price</div>
                                <div class="col-md-2">Quantity</div>
                                <div class="col-md-2">Subtotal</div>
                                <div class="col-md-1"></div>
                            </div>

                            @foreach($items as $item)
                                <!-- Producto loop -->
                                <div class="row align-items-center py-3 border-top">
                                    <div class="col-4 col-md-2 mb-3 mb-md-0">
                                        <img src="{{ $item->attributes->imagen }}" data-src="{{ $item->attributes->imagen }}"
                                            alt="{{ $item->name }}" class="product-image w-100 rounded"
                                            style="max-width: 80px;">
                                    </div>
                                    <div class="col-8 col-md-3 mb-3 mb-md-0 text-start">
                                        <h6 class="mb-1" style="font-size: 0.95rem; font-weight: 500;">{{ $item->name }}</h6>
                                    </div>
                                    <div class="col-4 col-md-2 text-center">
                                        <p class="mb-0 text-muted" style="font-size: 0.95rem;">
                                            ${{ number_format($item->price, 2) }}</p>
                                    </div>
                                    <div class="col-4 col-md-2 text-center">
                                        <input type="text" class="form-control text-center mx-auto"
                                            value="{{ $item->quantity }}" style="max-width: 60px; padding: 0.25rem 0.5rem;"
                                            wire:model="cantidades.{{ $item->id }}">
                                    </div>
                                    <div class="col-4 col-md-2 text-center">
                                        <p class="mb-0 fw-bold" style="font-size: 0.95rem;">
                                            ${{ number_format($item->price * $item->quantity, 2) }}</p>
                                    </div>
                                    <div class="col-12 col-md-1 text-end text-md-center mt-2 mt-md-0">
                                        <button class="btn btn-link text-muted p-0"
                                            wire:click.prevent="removeProducto('{{ $item->id }}')">
                                            <i class="bi bi-trash-fill" style="font-size: 1.2rem; color: #b0b0b0;"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-between mt-4 border-top pt-4">
                                <button class="btn btn-outline-secondary" wire:click.prevent="clearCarrito"
                                    style="font-size: 0.85rem; padding: 0.5rem 1rem;">
                                    <i class="bi bi-trash"></i> Vaciar Carrito
                                </button>
                                <a href="{{ route('tienda') }}" class="btn btn-outline-dark"
                                    style="font-size: 0.85rem; padding: 0.5rem 1rem;">
                                    <i class="bi bi-arrow-left"></i> Continuar Comprando
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resumen del pedido -->
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border: 3px solid #000; border-radius: 0;">
                        <div class="card-body" style="padding: 2.5rem 2rem;">
                            <h5 class="fw-bold mb-5" style="font-size: 1rem;">Resumen del pedido</h5>

                            <div class="d-flex justify-content-between mb-4" style="font-size: 0.95rem;">
                                <span class="fw-bold">Subtotal</span>
                                <span class="fw-bold">${{ number_format($subtotal, 2) }}</span>
                            </div>

                            <div class="mb-5" style="font-size: 0.95rem;">
                                <div class="fw-bold mb-3">Envío</div>
                                <div class="text-muted mb-4">Por favor, escríbenos por nuestro Chat para consultar el costo
                                    de envío.</div>
                                <!-- <a href="#" class="text-dark text-decoration-underline d-block mb-3" style="font-size: 0.85rem;">Cambiar dirección</a> -->
                            </div>

                            <div class="d-flex justify-content-between mb-4" style="font-size: 0.95rem;">
                                <span class="fw-bold">ITBMS</span>
                                <span class="fw-bold">${{ number_format($impuesto, 2) }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-5 mt-4" style="font-size: 1rem;">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold">${{ number_format($total, 2) }}</span>
                            </div>

                            <a href="{{ route('checkout') }}" class="btn w-100 fw-bold shadow-sm"
                                style="background-color: #D48A1F; color: #fff; padding: 1rem; border-radius: 0; font-size: 0.95rem; border: none;">
                                PAGAR AHORA
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>