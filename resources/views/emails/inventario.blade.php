<x-mail::message>
# Aviso de productos con stock bajo

<div>
    @foreach(tiendasDisponibles() as $slug => $tienda)
        <h4>Tienda: {{ $tienda }}</h4>
        <table style="width: 100%">
            <tr style="background: #555555; color: #ffffff; font-weight: bold">
                <td style="padding: 4px">SKU</td>
                <td style="padding: 4px">Producto</td>
                <td style="padding: 4px">Stock</td>
            </tr>
            @foreach($productos as $producto)
                @if($producto->disponible($tienda) <= 10)
                    <tr>
                        <td style="padding: 4px">{{ $producto->sku_producto }}</td>
                        <td style="padding: 4px">{{ $producto->nombre }}</td>
                        <td style="padding: 4px; color: #ff0000">{{$producto->disponible($tienda , true)}}</td>
                    </tr>
                @endif
            @endforeach
        </table>
    @endforeach
</div>

{{ config('app.name') }}
</x-mail::message>
