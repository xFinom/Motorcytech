<x-mail::message>
    # {{ config('app.name') }}

    Hola **{{ $user->name }}**,

    ¡Te notificamos que tu orden de servicio cuenta con una cotización de refacciones!

    <x-mail::button :url="route('profile.service.order.index')">
        Revisa tus ordenes de servicio pendientes.
    </x-mail::button>

    Si tienes algún problema, no dudes en contactarnos.

    Gracias,<br>
    El equipo de {{ config('app.name') }}
</x-mail::message>
