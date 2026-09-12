<x-guest-layout>

    <h2 class="text-center text-lg font-semibold mb-4" style="color: #1A3A5C;">
        Verificar Correo Electrónico
    </h2>

    <p class="text-sm text-gray-600 text-center mb-6">
        Se ha enviado un enlace de verificación a su correo electrónico.
        Por favor revise su bandeja de entrada y haga clic en el enlace para verificar su cuenta.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 rounded-lg text-sm" style="background-color: #D1FAE5; color: #27AE60;">
            Se ha enviado un nuevo enlace de verificación a su correo electrónico.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button
            type="submit"
            class="w-full py-2 px-4 rounded-lg text-white font-semibold text-sm transition-colors duration-200 mb-4"
            style="background-color: #1A3A5C;"
            onmouseover="this.style.backgroundColor='#2E74B5'"
            onmouseout="this.style.backgroundColor='#1A3A5C'"
        >
            Reenviar correo de verificación
        </button>

    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="text-center">
            <button type="submit" class="text-sm hover:underline" style="color: #2E74B5;">
                Cerrar sesión
            </button>
        </div>
    </form>

</x-guest-layout>
