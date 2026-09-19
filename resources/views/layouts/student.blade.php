<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistema LMS HGO') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" style="background-color: #F5F7FA;">

    {{-- Navbar --}}
    <nav style="background-color: #1A3A5C;" class="shadow-md">
        <div class="flex items-center justify-between px-6 py-3 mx-auto max-w-7xl">

            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logo-hro-blanco-horizontal.png') }}"
                     alt="HRO" class="object-contain h-10">
            </div>

            {{-- Navegación --}}
            <div class="items-center hidden gap-6 md:flex">
                <a href="{{ route('student.dashboard') }}"
                   class="text-sm font-medium transition-colors duration-200
                   {{ request()->routeIs('student.dashboard') ? 'text-white' : 'text-blue-200 hover:text-white' }}">
                    Inicio
                </a>
                <a href="{{ route('student.catalog') }}"
                   class="text-sm font-medium transition-colors duration-200
                   {{ request()->routeIs('student.catalog') ? 'text-white' : 'text-blue-200 hover:text-white' }}">
                    Catálogo
                </a>
                <a href="{{ route('student.diplomas') }}"
                   class="text-sm font-medium transition-colors duration-200
                   {{ request()->routeIs('student.diplomas') ? 'text-white' : 'text-blue-200 hover:text-white' }}">
                    Mis diplomas
                </a>
            </div>

            {{-- Usuario --}}
            <div class="flex items-center gap-3">
                <span class="hidden text-sm text-blue-200 md:block">
                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="text-xs text-blue-200 transition-colors duration-200 hover:text-white">
                        Cerrar sesión
                    </button>
                </form>
            </div>

        </div>
    </nav>

    {{-- Contenido --}}
    <main class="px-6 py-8 mx-auto max-w-7xl">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="py-6 text-xs text-center text-gray-400">
        © {{ date('Y') }} Hospital General de Occidente — Quetzaltenango
    </footer>

</body>
</html>
