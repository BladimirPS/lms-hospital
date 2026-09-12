<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema LMS HGO') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" style="background-color: #1A3A5C;">

    <div class="flex flex-col items-center justify-center min-h-screen px-4">



        {{-- Tarjeta --}}
        {{-- Tarjeta --}}
<div class="w-full max-w-md px-8 py-8 bg-white shadow-2xl rounded-xl">

    {{-- Logo dentro de la tarjeta --}}
    <div class="flex justify-center mb-4">
        <img src="{{ asset('img/logo-hro-azul-horizontal.png') }}" alt="HRO" class="object-contain h-20">
    </div>

    {{-- Título dentro de la tarjeta --}}
    <h1 class="mb-1 text-xl font-bold text-center" style="color: #1A3A5C;">
        Sistema de Gestión de Capacitación
    </h1>

    {{ $slot }}
</div>
        {{-- Footer --}}
        <p class="mt-6 text-xs text-center text-blue-200">
            © {{ date('Y') }} Hospital General de Occidente. Todos los derechos reservados.
        </p>

    </div>

</body>
</html>
