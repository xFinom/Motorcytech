<x-mail::message>
    # {{ config('app.name') }}

    ¡Pago recibido!

    <x-mail::button :url="route('dashboard.service.orders.historic')">
        Revisa las ordenes de servicio recientes
    </x-mail::button>

    Si tienes algún problema, no dudes en contactarnos.

    Gracias,<br>
    El equipo de {{ config('app.name') }}
</x-mail::message>
