<x-guest-layout :large-logo="true">
    <h1 class="mb-6 text-lg font-semibold text-gray-900">Iniciar sesión</h1>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" value="Correo electrónico" />
            <x-text-input id="email" class="mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" class="mt-1" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4 flex items-center justify-between">
            <label for="remember_me" class="flex items-center gap-2 text-sm text-gray-900">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-navy-100 text-navy-500 focus:ring-sky-500">
                Recordarme
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-sky-700 hover:underline" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <x-primary-button class="mt-6 w-full">
            Ingresar
        </x-primary-button>
    </form>
</x-guest-layout>
