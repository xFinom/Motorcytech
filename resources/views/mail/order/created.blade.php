<x-mail::message>
    # {{ config('app.name') }}

    Hola **{{ $user->name }}**,

    ¡Tu orden de servicio ha sido generada!

    <x-mail::button :url="route('profile.service.order.index')">
        Revisa tus ordenes de servicio.
    </x-mail::button>

    Si tienes algún problema, no dudes en contactarnos.

    Gracias,<br>
    El equipo de {{ config('app.name') }}
</x-mail::message>
