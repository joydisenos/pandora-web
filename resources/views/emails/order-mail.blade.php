<x-mail::message>
# {{ Str::title($order->nombreCompleto()) }} Gracias por realizar su compra👋

<div>
<p class="text-center">Felicitaciones, en estos momentos iniciaremos a procesar la entrega de su producto:</p>
<p>Pedido: <strong>{{$order->itemsNombres()}}</strong></p>
<p>Total: <strong>${{ number_format($order->precioConImpuesto() , 2) }}</strong></p>
<p>Datos de Pago:</p>
<p>{!! nl2br(opcionSlug('datos_transferencia')) !!}</p>
<p><strong>Productos más vendidos:</strong></p>
<ul>
@foreach(productosMasVendidos() as $producto)
<li>
<a style="text-decoration: none" href="{{route('producto' , Hashid::encode($producto->id) )}}">{{ $producto->nombre }}
</a></li>
@endforeach
</ul>
<p class="text-center">Ven y sigue navegando en nuestro sitio web <a href="{{ route('home') }}">{{ env('APP_URL') }}</a></p>
<p class="text-center">Si tienes alguna pregunta o necesitas ayuda escribenos a <a href="mailto:{{ opcionSlug('email_contacto') }}">{{ opcionSlug('email_contacto') }}</a></p>
</div>

<x-mail::button :url="route('panel')">
Ir a mi cuenta
</x-mail::button>

</x-mail::message>