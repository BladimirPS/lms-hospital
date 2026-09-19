@extends('layouts.student')

@section('content')

    <div class="flex gap-8">


        {{-- Sidebar izquierdo — índice del curso --}}
        <div class="flex-shrink-0 w-80">

            <div class="sticky p-5 bg-white shadow-sm rounded-xl top-6">

                <h2 class="mb-1 text-sm font-bold" style="color: #1A3A5C;">
                    Contenido del curso
                </h2>

                {{-- Barra de progreso --}}
                <div class="mb-4">
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

                {{-- Módulos y lecciones --}}
                @foreach($enrollment->course->modules as $module)

                    <div class="mb-3">
                        <p class="mb-2 text-xs font-semibold tracking-wide text-gray-600 uppercase">
                            {{ $module->title }}
                        </p>
                        <ul class="space-y-1">
                            @foreach($module->lessons as $lesson)
                                @php
                                    $viewed = $enrollment->lessonProgress
                                        ->where('lesson_id', $lesson->id)
                                        ->where('viewed', true)
                                        ->count() > 0;
                                @endphp
                                <li>
                                    <a href="?lesson={{ $lesson->id }}"
                                       class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs transition-colors duration-200
                                       {{ request('lesson') == $lesson->id ? 'text-white' : 'text-gray-600 hover:bg-gray-100' }}"
                                       style="{{ request('lesson') == $lesson->id ? 'background-color: #1A3A5C;' : '' }}">
                                        @if($viewed)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #27AE60;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @else
                                            <span class="flex-shrink-0 w-3 h-3 border border-gray-300 rounded-full"></span>
                                        @endif
                                        {{ $lesson->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

                {{-- Botón evaluación --}}
@if($enrollment->status === 'completed')
    <div class="pt-4 mt-4 border-t border-gray-100">
        <div class="block w-full px-4 py-2 text-sm font-medium text-center text-white rounded-lg"
             style="background-color: #27AE60;">
            ✓ Curso completado
        </div>
        @if($enrollment->course->generates_diploma)
    @if($enrollment->diploma)
        {{-- Diploma ya generado --}}
        <a href="{{ route('student.diplomas') }}"
           class="block w-full px-4 py-2 mt-2 text-sm font-medium text-center border rounded-lg"
           style="border-color: #27AE60; color: #27AE60;">
            📄 Ver mi diploma de este curso
        </a>
    @else
        {{-- Diploma pendiente de generarse --}}
        <div class="block w-full px-4 py-2 mt-2 text-sm font-medium text-center text-gray-400 border border-gray-300 rounded-lg">
            ⏳ Diploma en proceso de generación
        </div>
    @endif
@endif
    </div>

@elseif($enrollment->progress >= 100)
    <div class="pt-4 mt-4 border-t border-gray-100">
        <a href="{{ route('student.exam', $enrollment) }}"
           class="block w-full px-4 py-2 text-sm font-medium text-center text-white rounded-lg"
           style="background-color: #27AE60;">
            Ir a la evaluación final
        </a>
    </div>
@else
    <div class="pt-4 mt-4 border-t border-gray-100">
        <button disabled
                class="w-full px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
            Complete todas las lecciones para continuar
        </button>
    </div>
@endif

            </div>
        </div>

        {{-- Contenido principal --}}
        <div class="flex-1">
{{-- Navegación de lecciones --}}
<div class="flex items-center justify-between pt-4 mt-6 border-t border-gray-100">
    <span class="text-xs text-gray-400">
        ✓ Lección marcada como vista automáticamente
    </span>

    @if($nextLesson)
        <a href="?lesson={{ $nextLesson->id }}"
           class="flex items-center gap-2 px-6 py-2 text-sm font-medium text-white transition-colors duration-200 rounded-lg"
           style="background-color: #1A3A5C;"
           onmouseover="this.style.backgroundColor='#2E74B5'"
           onmouseout="this.style.backgroundColor='#1A3A5C'">
            Siguiente lección
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    @else
       @if($enrollment->status === 'completed')
    <div class="pt-4 mt-4 border-t border-gray-100">
        <div class="block w-full px-4 py-2 text-sm font-medium text-center text-white rounded-lg"
             style="background-color: #27AE60;">
            ✓ Curso completado
        </div>

    </div>
    </div>
@elseif($enrollment->progress >= 100)
    <div class="pt-4 mt-4 border-t border-gray-100">
        <a href="{{ route('student.exam', $enrollment) }}"
           class="block w-full px-4 py-2 text-sm font-medium text-center text-white rounded-lg"
           style="background-color: #27AE60;">
            Ir a la evaluación final
        </a>
    </div>
@else
    <div class="pt-4 mt-4 border-t border-gray-100">
        <button disabled
                class="w-full px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
            Complete todas las lecciones para continuar
        </button>
    </div>
@endif
    @endif
</div>
            {{-- Título del curso --}}
            <div class="mb-6">
                <a href="{{ route('student.dashboard') }}"
                   class="inline-block mb-2 text-xs text-gray-400 hover:text-gray-600">
                    ← Volver al inicio
                </a>
                <h1 class="text-2xl font-bold" style="color: #1A3A5C;">
                    {{ $enrollment->course->title }}
                </h1>
            </div>

            {{-- Lección activa --}}
            @php
                $allLessons = $enrollment->course->modules->flatMap->lessons;
                $currentLesson = request('lesson')
                    ? $allLessons->firstWhere('id', request('lesson'))
                    : $allLessons->first();
            @endphp

            @if($currentLesson)
                <div class="p-6 bg-white shadow-sm rounded-xl">
                    <h2 class="mb-4 text-lg font-semibold text-gray-800">
                        {{ $currentLesson->title }}
                    </h2>

                    {{-- Contenido según tipo --}}
                    @if($currentLesson->type === 'youtube_video')
                        @php
                            preg_match('/(?:v=|youtu\.be\/)([^&\s]+)/', $currentLesson->youtube_url, $matches);
                            $videoId = $matches[1] ?? null;
                        @endphp
                        @if($videoId)
                            <div class="mb-4 aspect-video">
                                <iframe class="w-full h-full rounded-lg"
                                        src="https://www.youtube.com/embed/{{ $videoId }}"
                                        frameborder="0" allowfullscreen>
                                </iframe>
                            </div>
                        @endif

                    @elseif($currentLesson->type === 'server_video')
                        <video controls class="w-full mb-4 rounded-lg">
                            <source src="{{ Storage::url($currentLesson->file_path) }}" type="video/mp4">
                        </video>

                    @elseif($currentLesson->type === 'pdf')
                        <iframe src="{{ Storage::url($currentLesson->file_path) }}"
                                class="w-full mb-4 rounded-lg h-96">
                        </iframe>

                    @elseif($currentLesson->type === 'article')
                        <div class="mb-4 prose text-gray-700 max-w-none">
                            {!! $currentLesson->content !!}
                        </div>
                    @endif

                    @if($currentLesson->description)
                        <p class="mb-4 text-sm text-gray-500">{{ $currentLesson->description }}</p>
                    @endif

                    {{-- Botón marcar como vista --}}
                    <form method="POST" action="{{ route('student.lesson.complete', [$enrollment, $currentLesson]) }}">
                        @csrf
                        <button type="submit"
                                class="px-6 py-2 text-sm font-medium text-white transition-colors duration-200 rounded-lg"
                                style="background-color: #1A3A5C;"
                                onmouseover="this.style.backgroundColor='#2E74B5'"
                                onmouseout="this.style.backgroundColor='#1A3A5C'">
                            ✓ Marcar como vista
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

@endsection
