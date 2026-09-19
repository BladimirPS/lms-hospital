<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes — Sistema LMS HGO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" style="background-color: #F5F7FA;">

    {{-- Navbar --}}
    <nav style="background-color: #1A3A5C;" class="mb-8 shadow-md">
        <div class="flex items-center justify-between px-6 py-3 mx-auto max-w-7xl">
            <img src="{{ asset('img/logo-hro-blanco-horizontal.png') }}" alt="HRO" class="object-contain h-10">
            <div class="flex items-center gap-4">
                <a href="/admin" class="text-sm text-blue-200 hover:text-white">← Panel admin</a>
                <span class="text-sm text-blue-200">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
            </div>
        </div>
    </nav>

    <div class="px-6 mx-auto max-w-7xl">

        {{-- Encabezado --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold" style="color: #1A3A5C;">Reportes y estadísticas</h1>
                <p class="mt-1 text-sm text-gray-500">Panel de inteligencia de negocios del sistema LMS</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.reports.excel') }}"
                   class="px-4 py-2 text-sm font-medium text-white rounded-lg"
                   style="background-color: #27AE60;">
                    ↓ Exportar Excel
                </a>
                <a href="{{ route('admin.reports.pdf') }}"
                   class="px-4 py-2 text-sm font-medium text-white rounded-lg"
                   style="background-color: #E74C3C;">
                    ↓ Exportar PDF
                </a>
            </div>
        </div>

        {{-- KPI Cards --}}
        <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-5">
            <div class="p-5 text-center bg-white shadow-sm rounded-xl">
                <p class="text-3xl font-bold" style="color: #1A3A5C;">{{ $totalUsers }}</p>
                <p class="mt-1 text-xs text-gray-500">Empleados registrados</p>
            </div>
            <div class="p-5 text-center bg-white shadow-sm rounded-xl">
                <p class="text-3xl font-bold" style="color: #2E74B5;">{{ $totalCourses }}</p>
                <p class="mt-1 text-xs text-gray-500">Cursos publicados</p>
            </div>
            <div class="p-5 text-center bg-white shadow-sm rounded-xl">
                <p class="text-3xl font-bold" style="color: #E67E22;">{{ $totalEnrollments }}</p>
                <p class="mt-1 text-xs text-gray-500">Total inscripciones</p>
            </div>
            <div class="p-5 text-center bg-white shadow-sm rounded-xl">
                <p class="text-3xl font-bold" style="color: #27AE60;">{{ $totalCompleted }}</p>
                <p class="mt-1 text-xs text-gray-500">Cursos completados</p>
            </div>
            <div class="p-5 text-center bg-white shadow-sm rounded-xl">
                <p class="text-3xl font-bold" style="color: #8E44AD;">{{ $totalDiplomas }}</p>
                <p class="mt-1 text-xs text-gray-500">Diplomas emitidos</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">

            {{-- Progreso por curso --}}
            <div class="p-6 bg-white shadow-sm rounded-xl">
                <h2 class="mb-4 text-lg font-bold" style="color: #1A3A5C;">Progreso por curso</h2>
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="pb-2 font-medium text-left text-gray-500">Curso</th>
                            <th class="pb-2 font-medium text-center text-gray-500">Inscritos</th>
                            <th class="pb-2 font-medium text-center text-gray-500">Completados</th>
                            <th class="pb-2 font-medium text-center text-gray-500">%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courseProgress as $course)
                            <tr class="border-b border-gray-50">
                                <td class="py-2 text-gray-700">{{ str($course->title)->limit(30) }}</td>
                                <td class="py-2 text-center text-gray-600">{{ $course->enrollments_count }}</td>
                                <td class="py-2 text-center text-gray-600">{{ $course->completed_count }}</td>
                                <td class="py-2 text-center">
                                    @php
                                        $pct = $course->enrollments_count > 0
                                            ? round(($course->completed_count / $course->enrollments_count) * 100)
                                            : 0;
                                    @endphp
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full"
                                          style="background-color: {{ $pct >= 70 ? '#EDFAF1' : '#FFF3E0' }}; color: {{ $pct >= 70 ? '#27AE60' : '#E67E22' }};">
                                        {{ $pct }}%
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Top cursos --}}
            <div class="p-6 bg-white shadow-sm rounded-xl">
                <h2 class="mb-4 text-lg font-bold" style="color: #1A3A5C;">Cursos más populares</h2>
                @foreach($topCourses as $course)
                    <div class="mb-4">
                        <div class="flex justify-between mb-1 text-sm">
                            <span class="text-gray-700">{{ str($course->title)->limit(35) }}</span>
                            <span class="font-medium text-gray-500">{{ $course->enrollments_count }}</span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full">
                            @php
                                $max = $topCourses->max('enrollments_count');
                                $width = $max > 0 ? round(($course->enrollments_count / $max) * 100) : 0;
                            @endphp
                            <div class="h-2 rounded-full" style="width: {{ $width }}%; background-color: #1A3A5C;"></div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- Empleados con cursos pendientes --}}
        <div class="p-6 mb-8 bg-white shadow-sm rounded-xl">
            <h2 class="mb-4 text-lg font-bold" style="color: #1A3A5C;">
                Empleados con cursos pendientes
                <span class="ml-2 text-sm font-normal text-gray-400">({{ $pendingUsers->count() }} empleados)</span>
            </h2>
            @if($pendingUsers->count() > 0)
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="pb-2 font-medium text-left text-gray-500">Empleado</th>
                            <th class="pb-2 font-medium text-left text-gray-500">Sección</th>
                            <th class="pb-2 font-medium text-left text-gray-500">Cursos pendientes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingUsers as $user)
                            <tr class="border-b border-gray-50">
                                <td class="py-2 text-gray-700">
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </td>
                                <td class="py-2 text-gray-500">
                                    {{ $user->section->name ?? 'Sin sección' }}
                                </td>
                                <td class="py-2">
                                    @foreach($user->enrollments->where('status', 'in_progress') as $e)
                                        <span class="inline-block px-2 py-1 mb-1 mr-1 text-xs rounded-full"
                                              style="background-color: #FFF3E0; color: #E67E22;">
                                            {{ str($e->course->title)->limit(25) }}
                                        </span>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-sm text-gray-400">Todos los empleados han completado sus cursos asignados.</p>
            @endif
        </div>

    </div>

</body>
</html>
