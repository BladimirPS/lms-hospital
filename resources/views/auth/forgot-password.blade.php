<x-guest-layout>

    <h2 class="text-center text-lg font-semibold mb-4" style="color: #1A3A5C;">
        Recuperar Contraseña
    </h2>

    <p class="text-sm text-gray-600 text-center mb-6">
        Ingrese su correo electrónico y le enviaremos un enlace para restablecer su contraseña.
    </p>

    @if (session('status'))
        <div class="mb-4 p-3 rounded-lg text-sm" style="background-color: #D1FAE5; color: #27AE60;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

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
                autofocus
                placeholder="correo@hgo.gob.gt"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2"
            >
            @error('email')
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
            Enviar enlace de recuperación
        </button>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm hover:underline" style="color: #2E74B5;">Volver al inicio de sesión</a>
        </div>

    </form>

</x-guest-layout>
