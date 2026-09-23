@extends('layouts.student')

@section('content')
    {{-- Bienvenida --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold" style="color: #1A3A5C;">
            Bienvenido, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            {{ auth()->user()->position->name ?? 'Empleado' }} —
            {{ auth()->user()->section->name ?? '' }}
        </p>
    </div>

   {{-- Tarjetas de resumen --}}
<div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">

    <a href="{{ route('student.courses.progress') }}"
       class="flex items-center gap-4 p-6 transition-shadow duration-200 bg-white shadow-sm rounded-xl hover:shadow-md">
        <div class="p-3 rounded-full" style="background-color: #EBF3FB;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #1A3A5C;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Cursos en progreso</p>
            <p class="text-2xl font-bold" style="color: #1A3A5C;">{{ $inProgress->count() }}</p>
        </div>
    </a>

    <a href="{{ route('student.courses.completed') }}"
       class="flex items-center gap-4 p-6 transition-shadow duration-200 bg-white shadow-sm rounded-xl hover:shadow-md">
        <div class="p-3 rounded-full" style="background-color: #EDFAF1;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #27AE60;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Cursos completados</p>
            <p class="text-2xl font-bold" style="color: #27AE60;">{{ $completed->count() }}</p>
        </div>
    </a>

    <a href="{{ route('student.diplomas') }}"
       class="flex items-center gap-4 p-6 transition-shadow duration-200 bg-white shadow-sm rounded-xl hover:shadow-md">
        <div class="p-3 rounded-full" style="background-color: #FFF3E0;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #E67E22;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Diplomas obtenidos</p>
            <p class="text-2xl font-bold" style="color: #E67E22;">{{ $diplomas->count() }}</p>
        </div>
    </a>

</div>
    {{-- Cursos completados --}}
@if($completed->count() > 0)
    <div class="mb-8">
        <h2 class="mb-4 text-lg font-bold" style="color: #1A3A5C;">
            Cursos completados
        </h2>

        @foreach($completed as $enrollment)
            <div class="flex items-center justify-between p-6 mb-4 bg-white shadow-sm rounded-xl">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full"
                              style="background-color: #EBF3FB; color: #1A3A5C;">
                            {{ $enrollment->course->type === 'talk' ? 'Charla' : 'Taller' }}
                        </span>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full"
                              style="background-color: #EDFAF1; color: #27AE60;">
                            Completado
                        </span>
                    </div>
                    <h3 class="font-semibold text-gray-800">{{ $enrollment->course->title }}</h3>
                    <div class="mt-2">
                        <div class="w-full h-2 bg-gray-200 rounded-full">
                            <div class="h-2 rounded-full"
                                 style="width: 100%; background-color: #27AE60;">
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-400">100% completado</p>
                    </div>
                </div>

                <div class="flex gap-2 ml-6">
                    <a href="{{ route('student.course.show', $enrollment) }}"
                       class="px-4 py-2 text-sm font-medium transition-colors duration-200 border rounded-lg"
                       style="border-color: #1A3A5C; color: #1A3A5C;">
                        Ver contenido
                    </a>
                    @if($enrollment->diploma)
                        <a href="{{ route('student.diplomas') }}"
                           class="px-4 py-2 text-sm font-medium text-white rounded-lg"
                           style="background-color: #27AE60;">
                            Ver diploma
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif

    {{-- Cursos en progreso --}}
    <div class="mb-8">
        <h2 class="mb-4 text-lg font-bold" style="color: #1A3A5C;">
            Cursos asignados pendientes
        </h2>

        @forelse($inProgress as $enrollment)
            <div class="flex items-center justify-between p-6 mb-4 bg-white shadow-sm rounded-xl">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full"
                              style="background-color: #EBF3FB; color: #1A3A5C;">
                            {{ $enrollment->course->type === 'talk' ? 'Charla' : 'Taller' }}
                        </span>
                        @if($enrollment->course->due_date && $enrollment->course->due_date->diffInDays(now()) <= 7)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full"
                                  style="background-color: #FFF3E0; color: #E67E22;">
                                Vence pronto
                            </span>
                        @endif
                    </div>
                    <h3 class="font-semibold text-gray-800">{{ $enrollment->course->title }}</h3>
                    @if($enrollment->course->due_date)
                        <p class="mt-1 text-xs text-gray-400">
                            Vence el {{ $enrollment->course->due_date->format('d/m/Y') }}
                        </p>
                    @endif

                    {{-- Barra de progreso --}}
                    <div class="mt-3">
                        <div class="flex justify-between mb-1 text-xs text-gray-500">
                            <span>Progreso</span>
                            <span>{{ $enrollment->progress }}%</span>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full">
                            <div class="h-2 transition-all duration-300 rounded-full"
                                 style="width: {{ $enrollment->progress }}%; background-color: #1A3A5C;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ml-6">
                    <a href="{{ route('student.course.show', $enrollment) }}"
                       class="px-4 py-2 text-sm font-medium text-white transition-colors duration-200 rounded-lg"
                       style="background-color: #1A3A5C;"
                       onmouseover="this.style.backgroundColor='#2E74B5'"
                       onmouseout="this.style.backgroundColor='#1A3A5C'">
                        Continuar
                    </a>
                </div>
            </div>
        @empty
            <div class="p-6 text-sm text-center text-gray-400 bg-white shadow-sm rounded-xl">
                No tienes cursos pendientes en este momento.
            </div>
        @endforelse
    </div>

    {{-- Diplomas obtenidos --}}
    @if($diplomas->count() > 0)
        <div>
            <h2 class="mb-4 text-lg font-bold" style="color: #1A3A5C;">
                Diplomas obtenidos
            </h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach($diplomas as $enrollment)
                    <div class="flex items-center justify-between p-6 bg-white shadow-sm rounded-xl">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $enrollment->course->title }}</h3>
                            <p class="mt-1 text-xs text-gray-400">
                                Emitido el {{ $enrollment->diploma->issued_at->format('d/m/Y') }}
                            </p>
                            <p class="text-xs text-gray-400">
                                Código: {{ $enrollment->diploma->diploma_code }}
                            </p>
                        </div>
                        <a href="{{ route('student.diplomas') }}"
                           class="px-4 py-2 text-sm font-medium transition-colors duration-200 border rounded-lg"
                           style="border-color: #1A3A5C; color: #1A3A5C;">
                            Descargar
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


@endsection
