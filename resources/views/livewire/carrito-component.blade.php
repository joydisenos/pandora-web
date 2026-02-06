<div>

	    <div class="container my-5 container pt-1">
			<div class="row">
				<div class="col-12">
					<h3 class="mb-4">Carrito de Compras</h3>
				</div>
			</div>

			

			@if(Cart::isEmpty())
				<!-- Carrito vacío (comentado por defecto) -->
				<div class="row">
					<div class="col-12">
						<div class="card shadow-sm">
							<div class="card-body empty-cart">
								<i class="bi bi-cart-x"></i>
								<h3 class="mb-3">Tu carrito está vacío</h3>
								<p class="text-muted mb-4">Parece que aún no has agregado productos a tu carrito.</p>
								<a href="{{ route('tienda') }}" class="btn btn-primary">Comenzar a Comprar</a>
							</div>
						</div>
					</div>
				</div>
			@else
				<!-- Carrito con productos -->
				<div class="row">
					<!-- Lista de productos -->
					<div class="col-lg-12">
						<div class="card shadow-sm mb-4">
							<div class="card-body">
								@foreach($items as $item)
									<!-- Producto loop -->
									<div class="row align-items-center mb-4 border-bottom pb-4">
										<div class="col-md-2">
											<img src="{{ $item->attributes->imagen }}" data-src="{{ $item->attributes->imagen }}" alt="{{ $item->name }}" class="product-image w-100 rounded">
										</div>
										<div class="col-md-3">
											<h5 class="mb-1">{{ $item->name }}</h5>
										</div>
										<div class="col-md-2">
											<p class="mb-0 fw-bold">{{ $item->qty }}</p>
										</div>
										<div class="col-md-3">
											<div class="input-group input-group-sm mb-4">
												<!-- <button class="btn btn-outline-secondary quantity-btn" type="button">-</button> -->
												<input type="text" class="form-control text-center" value="{{ $item->quantity }}" style="max-width: 50px;" wire:model="cantidades.{{ $item->id }}">
												<!-- <button class="btn btn-outline-secondary quantity-btn" type="button">+</button> -->
											</div>
										</div>
										<div class="col-md-2 text-end">
											<!-- <p class="mb-0 fw-bold">$89.99</p> -->
											<button class="btn btn-link text-danger p-0 mt-1" wire:click.prevent="removeProducto('{{ $item->id }}')"removeProducto>
												<i class="bi bi-trash"></i> Eliminar
											</button>
										</div>
									</div>
								@endforeach

								<div class="d-flex justify-content-between">
									<button class="btn-pri-rojo" wire:click.prevent="clearCarrito">
										<i class="bi bi-trash"></i> Vaciar Carrito
									</button>
								
									<a href="{{ route('tienda') }}" class="btn-pri-claro">
										<i class="bi bi-arrow-left"></i> Continuar Comprando
									</a>
									
									<a href="{{ route('checkout') }}" class="btn-pri-claro">
										<i class="bi bi-check"></i> Confirmar Compra
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>



</div>
