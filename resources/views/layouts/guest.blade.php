@props(['largeLogo' => false])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LMS HRO') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-8">

        <!-- Encabezado de marca: logo + nombre del sistema -->
        @if ($largeLogo)
            {{-- Variante grande, centrada — solo para login --}}
            <div class="mb-6 flex flex-col items-center gap-4">
                <a href="/">
                    <img src="{{ asset('images/logo-hro.jpeg') }}"
                         alt="Hospital Regional de Occidente"
                         class="h-32 w-auto sm:h-36">
                </a>
                <span class="text-base font-semibold text-navy-500 text-center leading-snug">
                    Sistema de Gestión de Aprendizaje
                    <span class="block text-sm font-normal text-navy-300">Hospital Regional de Occidente</span>
                </span>
            </div>
        @else
            {{-- Variante compacta — registro, recuperación, confirmación, etc. --}}
            <div class="mb-8 flex flex-col items-center gap-3">
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-hro.jpeg') }}"
                         alt="Hospital Regional de Occidente"
                         class="h-12 w-auto">
                    <span class="text-lg font-semibold text-navy-500 leading-tight">
                        LMS<br class="hidden">
                        <span class="text-sm font-normal text-navy-300">Hospital Regional de Occidente</span>
                    </span>
                </a>
            </div>
        @endif

        <!-- Tarjeta contenedora del formulario -->
        <div class="w-full max-w-md bg-white border border-navy-100 rounded-xl shadow-sm px-6 py-8 sm:px-8">
            {{ $slot }}
        </div>

        <p class="mt-6 text-xs text-gray-600">
            &copy; {{ date('Y') }} Hospital Regional de Occidente — Sistema de Gestión de Aprendizaje
        </p>
    </div>
</body>
</html>
