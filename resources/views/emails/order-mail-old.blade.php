<x-mail::message>
# Orden #{{ $order->id }} realizada

<div>
<p>Su orden #{{ $order->id }} fué realizada correctamente</p>
<p>{{ $order->nombreCompleto() }}</p>
<p>Teléfono: {{ $order->telefono }}</p>
<p>Método de pago: {{ $order->tipo_pago }}</p>
<div>
<table style="width:100%">
<tr>
<td>Item</td>
<td>Cant.</td>
<td>Precio</td>
<td>Imp.</td>
<td>Total</td>
</tr>
@foreach($order->items as $item) 
<tr>
<td>{{ $item->nombre }}</td>
<td>{{ $item->cantidad }}</td>
<td>${{ $item->precio }}</td>
<td>${{ $item->impuesto() }}</td>
<td>${{ $item->totalImpuesto() }}</td>
</tr>
@endforeach
<tr>
<td></td>
<td></td>
<td></td>
<td>Total:</td>
<td>${{ $order->precioConImpuesto() }}</td>
</tr>
</table>
</div>
</div>

<x-mail::button :url="route('panel')">
Ir a mi cuenta
</x-mail::button>

<strong>{{ config('app.name') }}</strong>. {{ opcionSlug('direccion') }} | {{ opcionSlug('telefono_contacto') }}
</x-mail::message>
