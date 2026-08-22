<x-guest-layout>
    <h1 class="mb-4 text-lg font-semibold text-gray-900">Recuperar contraseña</h1>

    <p class="mb-4 text-sm text-gray-600">
        Ingresá tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
    </p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" value="Correo electrónico" />
            <x-text-input id="email" class="mt-1" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6 flex items-center justify-between">
            <a class="text-sm text-sky-700 hover:underline" href="{{ route('login') }}">
                Volver a iniciar sesión
            </a>

            <x-primary-button>
                Enviar enlace de recuperación
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
