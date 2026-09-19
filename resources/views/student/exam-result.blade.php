@extends('layouts.student')

@section('content')

    <div class="max-w-2xl mx-auto">

        {{-- Resultado --}}
        <div class="p-8 mb-6 text-center bg-white shadow-sm rounded-xl">

            @if($attempt->passed)
                {{-- Aprobado --}}
                <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 rounded-full"
                     style="background-color: #EDFAF1;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #27AE60;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h1 class="mb-2 text-2xl font-bold" style="color: #27AE60;">
                    ¡Felicitaciones, aprobó!
                </h1>
                <p class="mb-4 text-sm text-gray-500">
                    Ha completado exitosamente el curso
                    <strong>{{ $enrollment->course->title }}</strong>
                </p>
            @else
                {{-- Reprobado --}}
                <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 rounded-full"
                     style="background-color: #FEE2E2;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #E74C3C;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h1 class="mb-2 text-2xl font-bold" style="color: #E74C3C;">
                    No aprobó esta vez
                </h1>
                <p class="mb-4 text-sm text-gray-500">
                    Puede reintentar la evaluación cuantas veces necesite.
                </p>
            @endif

            {{-- Calificación --}}
            <div class="inline-flex items-center gap-2 px-6 py-3 mb-6 rounded-full"
                 style="background-color: {{ $attempt->passed ? '#EDFAF1' : '#FEE2E2' }};">
                <span class="text-3xl font-bold"
                      style="color: {{ $attempt->passed ? '#27AE60' : '#E74C3C' }};">
                    {{ $attempt->score }}%
                </span>
            </div>

            <div class="mb-6 text-xs text-gray-400">
                Nota mínima requerida: {{ $enrollment->course->minimum_score }}%
                &nbsp;|&nbsp;
                Intento #{{ $attempt->attempt_number }}
            </div>

            {{-- Acciones --}}
            <div class="flex flex-col justify-center gap-3 sm:flex-row">
                @if($attempt->passed)
                    @if($enrollment->course->generates_diploma)
                        <a href="{{ route('student.diplomas') }}"
                           class="px-6 py-3 text-sm font-medium text-white rounded-lg"
                           style="background-color: #27AE60;">
                            Ver mi diploma
                        </a>
                    @endif
                    <a href="{{ route('student.dashboard') }}"
                       class="px-6 py-3 text-sm font-medium border rounded-lg"
                       style="border-color: #1A3A5C; color: #1A3A5C;">
                        Volver al inicio
                    </a>
                @else
                    <a href="{{ route('student.exam', $enrollment) }}"
                       class="px-6 py-3 text-sm font-medium text-white rounded-lg"
                       style="background-color: #1A3A5C;">
                        Reintentar evaluación
                    </a>
                    <a href="{{ route('student.course.show', $enrollment) }}"
                       class="px-6 py-3 text-sm font-medium border rounded-lg"
                       style="border-color: #1A3A5C; color: #1A3A5C;">
                        Revisar el contenido
                    </a>
                @endif
            </div>

        </div>

    </div>

@endsection
