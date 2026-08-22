<x-guest-layout>
    <h1 class="mb-6 text-lg font-semibold text-gray-900">Crear cuenta</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Nombre completo" />
            <x-text-input id="name" class="mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Correo electrónico" />
            <x-text-input id="email" class="mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" class="mt-1" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar contraseña" />
            <x-text-input id="password_confirmation" class="mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6 flex items-center justify-between">
            <a class="text-sm text-sky-700 hover:underline" href="{{ route('login') }}">
                ¿Ya tenés cuenta?
            </a>

            <x-primary-button>
                Registrarme
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
