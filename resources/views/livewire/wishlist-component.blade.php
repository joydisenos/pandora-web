<div>
    <div class="container margin_120_95">
        <h2 class="text-center mb-5">Mis Favoritos</h2>
        
        @if(count($productos) > 0)
            <div class="isotope-wrapper">
                <div class="row">
                    @foreach ($productos as $producto)
                        <div class="item col-xl-3 col-lg-4 col-md-6 mb-4">
                            @include('includes.producto')
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center my-5">
                <h4>No tienes productos en tus favoritos</h4>
                <a href="{{ route('tienda') }}" class="btn_1 mt-3">Ir a la tienda</a>
            </div>
        @endif
    </div>
</div>
