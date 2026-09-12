<x-guest-layout>

    <h2 class="text-center text-lg font-semibold mb-6" style="color: #1A3A5C;">
        Crear Cuenta
    </h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Nombre completo
            </label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Juan Pérez"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2"
            >
            @error('name')
                <p class="text-xs mt-1" style="color: #E74C3C;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Correo electrónico
            </label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
                placeholder="correo@hgo.gob.gt"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2"
            >
            @error('email')
                <p class="text-xs mt-1" style="color: #E74C3C;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                Contraseña
            </label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="••••••••"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2"
            >
            @error('password')
                <p class="text-xs mt-1" style="color: #E74C3C;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                Confirmar contraseña
            </label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="••••••••"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2"
            >
            @error('password_confirmation')
                <p class="text-xs mt-1" style="color: #E74C3C;">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="w-full py-2 px-4 rounded-lg text-white font-semibold text-sm transition-colors duration-200"
            style="background-color: #1A3A5C;"
            onmouseover="this.style.backgroundColor='#2E74B5'"
            onmouseout="this.style.backgroundColor='#1A3A5C'"
        >
            Registrarse
        </button>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm hover:underline" style="color: #2E74B5;">¿Ya tiene una cuenta? Iniciar sesión</a>
        </div>

    </form>

</x-guest-layout>
