<div class="dropdown dropdown-cart">
    <a href="{{ route('carrito') }}" class="p-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
        </svg>
        <span class="cart-cantidad">{{ $cantidad }}</span>
    </a>
    <div class="dropdown-menu">
        <ul>
            @forelse($items as $item)
            <li>
                <a href="{{ route('producto' , Hashid::encode($item->id) ) }}">
                    <figure><img src="{{$item->attributes->imagen}}" data-src="{{$item->attributes->imagen}}" alt="" width="50" height="50" class="lazy"></figure>
                    <strong><span>{{ $item->name }}</span>${{ $item->price }} 
                        @if($item->quantity > 1)
                         x {{ $item->quantity }}
                        @endif
                    </strong>
                </a>
                <a href="#" wire:click.prevent="removeProducto({{ $item->id }})" class="action"><i class="ti-trash"></i></a>
                
            </li>
            @empty
            @endforelse
        </ul>
        <div class="total_drop">
            <div class="clearfix"><strong>Subtotal</strong><span>${{ \Cart::getTotal() }}</span></div>
            @if($impuesto)
            <div class="clearfix"><strong>ITBMS</strong><span>${{ $impuesto }}</span></div>
            @endif
            <div class="clearfix"><strong>Total</strong><span>${{ \Cart::getTotal() + $impuesto }}</span></div>
            <a href="{{ route('carrito') }}" class="btn_1 outline">Ver Carrito</a><a href="{{ route('checkout') }}" class="btn_1">Checkout</a>
        </div>
    </div>
</div>
