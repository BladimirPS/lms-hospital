<x-guest-layout>

    {{-- Subtítulo --}}
    <p class="text-center text-sm text-gray-500 mb-6">
        Portal de Formación Continua y Desarrollo Clínico
    </p>

    @if (session('status'))
        <div class="mb-4 p-3 rounded-lg text-sm" style="background-color: #D1FAE5; color: #27AE60;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Correo --}}
        <div class="mb-4">
            <div class="flex justify-between items-center mb-1">
                <label for="email" class="text-sm font-bold text-gray-800">
                    Correo institucional
                </label>
                <span class="text-xs font-bold tracking-widest" style="color: #2E74B5;">
                    OBLIGATORIO
                </span>
            </div>
            <div class="relative">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </span>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="ejemplo@hospital.gob.gt"
                    class="w-full pl-10 pr-4 py-3 border rounded-lg text-sm focus:outline-none focus:ring-2 {{ $errors->has('email') ? 'border-red-400' : 'border-gray-200' }}"
                    style="background-color: #F5F7FA;"
                >
            </div>
            @error('email')
                <p class="text-xs mt-1" style="color: #E74C3C;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Contraseña --}}
        <div class="mb-5">
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="text-sm font-bold text-gray-800">
                    Contraseña
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs hover:underline" style="color: #2E74B5;">¿Olvidó su contraseña?</a>
                @endif
            </div>
            <div class="relative">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </span>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••••"
                    class="w-full pl-10 pr-10 py-3 border rounded-lg text-sm focus:outline-none focus:ring-2 {{ $errors->has('password') ? 'border-red-400' : 'border-gray-200' }}"
                    style="background-color: #F5F7FA;"
                >
                <button
                    type="button"
                    onclick="togglePassword()"
                    class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600"
                >
                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="text-xs mt-1" style="color: #E74C3C;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Recordarme --}}
        <div class="flex items-center mb-6">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="rounded border-gray-300"
            >
            <label for="remember_me" class="ml-2 text-sm text-gray-600">
                Recordar credenciales en este equipo
            </label>
        </div>

        {{-- Botón --}}
        <button
            type="submit"
            class="w-full py-3 px-4 rounded-lg text-white font-semibold text-sm transition-colors duration-200 flex items-center justify-center gap-2"
            style="background-color: #1A3A5C;"
            onmouseover="this.style.backgroundColor='#2E74B5'"
            onmouseout="this.style.backgroundColor='#1A3A5C'"
        >
            Ingresar
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </button>

        {{-- Footer interno --}}
        <p class="text-center text-xs text-gray-400 mt-6">
            Hospital General de Occidente • Quetzaltenango
        </p>

    </form>

</x-guest-layout>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
