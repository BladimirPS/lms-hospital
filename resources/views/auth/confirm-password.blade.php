<x-guest-layout>
    <h1 class="mb-4 text-lg font-semibold text-gray-900">Confirmar contraseña</h1>

    <p class="mb-4 text-sm text-gray-600">
        Esta es un área protegida. Confirmá tu contraseña antes de continuar.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" class="mt-1" type="password" name="password" required autocomplete="current-password" autofocus />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="mt-6 w-full">
            Confirmar
        </x-primary-button>
    </form>
</x-guest-layout>
