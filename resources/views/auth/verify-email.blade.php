<x-guest-layout>
    <h1 class="mb-4 text-lg font-semibold text-gray-900">Verificá tu correo</h1>

    <p class="mb-4 text-sm text-gray-600">
        Gracias por registrarte. Antes de empezar, confirmá tu correo electrónico haciendo clic
        en el enlace que te enviamos. Si no lo recibiste, te podemos mandar otro.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 rounded-md bg-sky-100 border border-sky-300 px-4 py-3 text-sm text-navy-500">
            Te enviamos un nuevo enlace de verificación al correo que registraste.
        </div>
    @endif

    <div class="flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                Reenviar correo de verificación
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-sky-700 hover:underline">
                Cerrar sesión
            </button>
        </form>
    </div>
</x-guest-layout>
