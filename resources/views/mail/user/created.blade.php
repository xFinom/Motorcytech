<x-mail::message>
    # ¡Bienvenido a {{ config('app.name') }}!

    Hola **{{ $user->name }}**,

    ¡Tu cuenta ha sido creada con éxito! Estamos muy contentos de brindarte el mejor servicio de reparación.

    Aquí están tus credenciales para tu primer inicio de sesión:

    * **Usuario (Email):** {{ $user->email }}
    * **Contraseña Temporal:** `{{ $user->password }}`

    **Por favor, te recomendamos encarecidamente cambiar tu contraseña inmediatamente después de iniciar sesión por primera vez.**

    <x-mail::button :url="url('/login')">
        Ir a Iniciar Sesión
    </x-mail::button>

    Si tienes algún problema, no dudes en contactarnos.

    Gracias,<br>
    El equipo de {{ config('app.name') }}
</x-mail::message>
