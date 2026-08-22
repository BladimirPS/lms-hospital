<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-navy-900 leading-tight">
            {{ __('Panel del usuario') }}
        </h2>
    </x-slot>

    @php
        $userName = trim(auth()->user()->first_name . ' ' . auth()->user()->last_name);
        $initials = mb_strtoupper(mb_substr(auth()->user()->first_name, 0, 1) . mb_substr(auth()->user()->last_name, 0, 1));

        // Datos de muestra — sin conexión a datos reales todavía, solo para la vista.
        $stats = [
            ['label' => 'Cursos asignados', 'value' => 5, 'accent' => 'navy'],
            ['label' => 'Completados', 'value' => 2, 'accent' => 'success'],
            ['label' => 'En progreso', 'value' => 2, 'accent' => 'warning'],
            ['label' => 'Diplomas obtenidos', 'value' => 2, 'accent' => 'info'],
        ];

        $courses = [
            ['name' => 'Bioseguridad y manejo de desechos hospitalarios', 'category' => 'Obligatorio', 'progress' => 100, 'status' => 'Completado'],
            ['name' => 'Reanimación cardiopulmonar básica', 'category' => 'Obligatorio', 'progress' => 60, 'status' => 'En progreso'],
            ['name' => 'Atención al usuario en servicios de salud', 'category' => 'Complementario', 'progress' => 30, 'status' => 'En progreso'],
            ['name' => 'Prevención de infecciones intrahospitalarias', 'category' => 'Obligatorio', 'progress' => 0, 'status' => 'Sin iniciar'],
        ];
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Banner de bienvenida --}}
            <div class="relative overflow-hidden rounded-xl shadow-sm bg-gradient-to-r from-navy-900 to-navy-700">
                <div class="relative p-8">
                    <p class="text-sky-300 text-sm font-medium uppercase tracking-wide">
                        Hospital Regional de Occidente
                    </p>
                    <h3 class="mt-1 text-2xl font-semibold text-white">
                        Bienvenido, {{ $userName }}
                    </h3>
                    <p class="mt-2 text-sky-100 text-sm max-w-xl">
                        Sistema de Gestión de Aprendizaje — continuá tus capacitaciones asignadas y
                        revisá tu progreso desde este panel.
                    </p>
                </div>
            </div>

            {{-- Tarjetas de estadísticas --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($stats as $stat)
                    @php
                        $accentMap = [
                            'navy' => ['bg' => 'bg-navy-100', 'text' => 'text-navy-700'],
                            'success' => ['bg' => 'bg-green-100', 'text' => 'text-green-700'],
                            'warning' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-700'],
                            'info' => ['bg' => 'bg-sky-100', 'text' => 'text-sky-700'],
                        ][$stat['accent']];
                    @endphp
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg {{ $accentMap['bg'] }} {{ $accentMap['text'] }}">
                                @if ($stat['label'] === 'Cursos asignados')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                @elseif ($stat['label'] === 'Completados')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                @elseif ($stat['label'] === 'En progreso')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <circle cx="12" cy="8" r="5" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.5 12.5 7 21l5-3 5 3-1.5-8.5" />
                                    </svg>
                                @endif
                            </span>
                            <div>
                                <p class="text-2xl font-semibold text-navy-900">{{ $stat['value'] }}</p>
                                <p class="text-xs text-gray-500">{{ $stat['label'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Mis cursos --}}
                <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h4 class="font-semibold text-navy-900">Mis cursos</h4>
                        <span class="text-xs text-gray-400">Vista de muestra — sin datos reales todavía</span>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @foreach ($courses as $course)
                            <div class="px-6 py-4">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $course['name'] }}</p>
                                        <span class="inline-block mt-1 text-xs px-2 py-0.5 rounded-full bg-navy-100 text-navy-700">
                                            {{ $course['category'] }}
                                        </span>
                                    </div>
                                    <span class="shrink-0 text-xs font-medium text-gray-500">{{ $course['status'] }}</span>
                                </div>
                                <div class="mt-3 h-2 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full rounded-full bg-navy-500" style="width: {{ $course['progress'] }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Barra lateral --}}
                <div class="space-y-6">

                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 text-center">
                        <div class="mx-auto w-16 h-16 rounded-full bg-navy-900 text-white flex items-center justify-center text-lg font-semibold">
                            {{ $initials }}
                        </div>
                        <p class="mt-3 font-medium text-gray-900">{{ $userName }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->position ?? 'Personal del hospital' }}</p>
                        @if (auth()->user()->section)
                            <p class="mt-1 text-xs text-navy-700">{{ auth()->user()->section->name }}</p>
                        @endif
                    </div>

                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h4 class="font-semibold text-navy-900 text-sm">Próximos vencimientos</h4>
                        </div>
                        <ul class="divide-y divide-gray-100 text-sm">
                            <li class="px-6 py-3 flex items-center justify-between">
                                <span class="text-gray-700">Reanimación cardiopulmonar básica</span>
                                <span class="text-xs text-amber-700 font-medium">5 días</span>
                            </li>
                            <li class="px-6 py-3 flex items-center justify-between">
                                <span class="text-gray-700">Prevención de infecciones</span>
                                <span class="text-xs text-red-700 font-medium">2 días</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>



        </div>
    </div>
</x-app-layout>
