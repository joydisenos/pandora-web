<div>

	<div class="container my-5 container pt-1">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4">Checkout</h3>
            </div>
        </div>

        <div class="row">
            <!-- Información de la solicitud -->
            <div class="col-lg-8">
                <!-- Información de contacto -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            <i class="bi bi-person me-2"></i>Información de Contacto
                        </h4>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre *</label>
                                <input type="text" class="form-control" id="nombre" wire:model="orden.nombre" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellido" class="form-label">Apellido *</label>
                                <input type="text" class="form-control" id="apellido" wire:model="orden.apellido" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico *</label>
                            <input type="email" class="form-control" id="email" wire:model="orden.email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono *</label>
                            <input type="tel" class="form-control" id="telefono" wire:model="orden.telefono" required>
                        </div>
                        <div class="mb-3">
                            <label for="cedula" class="form-label">Cédula / DNI *</label>
                            <input type="tel" class="form-control" id="cedula" wire:model="orden.cedula" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección *</label>
                            <input type="tel" class="form-control" id="direccion" wire:model="orden.direccion" required>
                        </div>
                    </div>
                </div>


                <!-- Métodos de Pago -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            <i class="bi bi-credit-card me-2"></i>Métodos de Pago
                        </h4>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Método de Pago Preferido *</label>
                            <div class="mt-2">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="metodoPago" id="pagoACH" wire:model="orden.contacto" value="ACH" checked>
                                    <label class="form-check-label" for="pagoACH">ACH</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="metodoPago" id="pagoYappy" wire:model="orden.contacto" value="Yappy">
                                    <label class="form-check-label" for="pagoYappy">Yappy</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="metodoPago" id="pagoTarjeta" wire:model="orden.contacto" value="Pago con tarjeta">
                                    <label class="form-check-label" for="pagoTarjeta">Pago con tarjeta</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="notasPago" class="form-label">Notas Adicionales (Opcional)</label>
                            <textarea class="form-control" id="notasPago" wire:model="orden.contacto_horario" rows="3" placeholder="Ingrese cualquier información adicional sobre el pago..."></textarea>
                        </div>
                        
                        <!-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="newsletter">
                            <label class="form-check-label" for="newsletter">
                                Deseo recibir información sobre promociones y novedades
                            </label>
                        </div> -->
                    </div>
                </div>
            </div>

            <!-- Resumen de la solicitud -->
            <div class="col-lg-4">
                <div class="card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Resumen de la Solicitud</h4>
                        
                        <!-- Productos seleccionados -->
                        <div class="mb-3">
                            <h6 class="mb-3">Productos Solicitados:</h6>

							@foreach($items as $item)
                                <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                                    <img src="{{ $item->attributes->imagen }}" alt="Producto" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ $item->name }}</h6>
                                        <p class="text-muted mb-0">Cantidad: {{ $item->quantity }} | Total: ${{ $item->quantity * $item->price }}</p>
                                    </div>
                                </div>
							@endforeach
                        
                        <!-- <div class="mb-4">
                            <h6 class="mb-2">Información Adicional:</h6>
                            <ul class="list-unstyled small">
                                <li class="mb-1">• Presupuesto sin compromiso</li>
                                <li class="mb-1">• Respuesta en 24-48 horas</li>
                                <li class="mb-1">• Personalizable según necesidades</li>
                            </ul>
                        </div> -->
                        
                        
                        
                        @if(isset($impuesto) && $impuesto > 0)
                        <div class="mb-1">
                            <p class="text-muted small text-right mb-0">
                                <strong>ITBMS: ${{ number_format($impuesto, 2) }}</strong>
                            </p>
                        </div>
                        @endif
                        <div class="mb-0">
                            <p class="text-muted small text-right mb-0">
                                <strong>Total: ${{ number_format($total, 2) }}</strong>
                            </p>
                        </div>
                        <hr>
                        
                        <div class="mb-4 text-muted" style="font-size: 0.8rem; text-align: justify;">
                            Sus datos personales se utilizarán para procesar su pedido, respaldar su experiencia en este sitio web y para otros fines descritos en nuestro <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal" class="text-dark fw-bold text-decoration-underline">privacy policy</a>.
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terminos" required>
                            <label class="form-check-label text-dark fw-bold" for="terminos" style="font-size: 0.85rem;">
                                Estoy de acuerdo con los términos y condiciones. *
                            </label>
                        </div>

						<div class="mb-4">
							@include('includes.mensajes')
                        </div>
                        
                        <button class="d-block w-100 py-3 mb-3 fw-bold shadow-sm" wire:click.prevent="ordenar" style="background-color: #D48A1F; color: #fff; border: none; border-radius: 0; font-size: 0.95rem;">
                            Completar Compra
                        </button>
                        
                        <a href="{{ route('carrito') }}" class="d-block btn-pri-blanco w-100 py-2 text-center">
                            <i class="bi bi-arrow-left me-2"></i>Volver al Carrito
                        </a>
                        
                        <!-- <div class="text-center mt-4">
                            <p class="small text-muted">
                                <i class="bi bi-clock me-1"></i>
                                Tiempo de respuesta: 24-48 horas
                            </p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
