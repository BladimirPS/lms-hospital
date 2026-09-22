<x-guest-layout>

    <div class="text-center">
        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full"
             style="background-color: #FEE2E2;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #E74C3C;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>

        <h2 class="mb-2 text-lg font-semibold" style="color: #1A3A5C;">
            Enlace expirado
        </h2>
        <p class="mb-6 text-sm text-gray-500">
            El enlace de activación ha expirado o no es válido. Solicite al administrador que reenvíe la invitación.
        </p>

        <a href="{{ route('login') }}"
           class="text-sm hover:underline"
           style="color: #2E74B5;">
            Volver al inicio de sesión
        </a>
    </div>

</x-guest-layout>
