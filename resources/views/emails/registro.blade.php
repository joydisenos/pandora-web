<x-mail::message>
# Bienvenidos a {{ env('APP_NAME') }} , {{ Str::title($user->name) }} 👋

<div>
<p class="text-center">Felicitaciones, ahora formas parte de nuestra grandiosa comunidad ecommerce {{ env('APP_NAME') }} {{ $user->name }} <br>Donde podrás encontrar nuestros productos</p>
<ul>
@foreach(productosMasVendidos() as $producto)
<li>
<a style="text-decoration: none" href="{{route('producto' , Hashid::encode($producto->id) )}}">{{ $producto->nombre }}
</a></li>
@endforeach
</ul>
<p class="text-center">Ven y sigue navegando en nuestro sitio web <a href="{{ route('home') }}">{{ route('home') }}</a> <br>Si tienes alguna pregunta o necesitas ayuda escribenos a {{ opcionSlug('email_contacto') }}</p>
</div>

<x-mail::button :url="route('panel')">
Ir a mi cuenta
</x-mail::button>

</x-mail::message>
