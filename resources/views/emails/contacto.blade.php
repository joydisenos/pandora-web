<x-mail::message>
# {{ $datos['asunto'] }} Cliente: {{ $datos['nombre'] }}

<div>
    <p>{{ $datos['mensaje'] }}</p>
    <p>Cliente: {{ $datos['nombre'] }}</p>
    <p>Teléfono: {{ $datos['telefono'] }}</p>
    <p>Email: {{ $datos['email'] }}</p>
</div>

<x-mail::button :url="route('dashboard')">
Ir a la web
</x-mail::button>

</x-mail::message>
