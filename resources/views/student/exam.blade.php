@extends('layouts.student')

@section('content')

    <div class="max-w-3xl mx-auto">

        {{-- Encabezado --}}
        <div class="mb-6">
            <a href="{{ route('student.course.show', $enrollment) }}"
               class="inline-block mb-2 text-xs text-gray-400 hover:text-gray-600">
                ← Volver al curso
            </a>
            <h1 class="text-2xl font-bold" style="color: #1A3A5C;">
                Evaluación final
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                {{ $enrollment->course->title }}
            </p>
            <p class="mt-1 text-xs text-gray-400">
                Nota mínima de aprobación: {{ $enrollment->course->minimum_score }}%
            </p>
        </div>

        {{-- Formulario de evaluación --}}
        <form method="POST" action="{{ route('student.exam.submit', $enrollment) }}">
            @csrf

            @foreach($questions as $index => $question)
                <div class="p-6 mb-4 bg-white shadow-sm rounded-xl">

                    {{-- Número y enunciado --}}
                    <p class="mb-1 text-xs font-semibold text-gray-400">
                        Pregunta {{ $index + 1 }} de {{ $questions->count() }}
                    </p>
                    <p class="mb-3 font-semibold text-gray-800">
                        {{ $question->text }}
                    </p>

                    {{-- Imagen adjunta --}}
                    @if($question->image)
                        <img src="{{ Storage::url($question->image) }}"
                             class="object-contain mb-4 rounded-lg max-h-48">
                    @endif

                    {{-- Opciones --}}
                    <div class="space-y-2">
                        @foreach($question->options as $option)
                            <label class="flex items-center gap-3 p-3 transition-colors duration-200 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-300">
                                @if($question->type === 'multiple_choice')
                                    <input type="checkbox"
                                           name="answers[{{ $question->id }}][]"
                                           value="{{ $option->id }}"
                                           class="rounded">
                                @else
                                    <input type="radio"
                                           name="answers[{{ $question->id }}]"
                                           value="{{ $option->id }}"
                                           class="rounded-full">
                                @endif
                                <span class="text-sm text-gray-700">{{ $option->text }}</span>
                            </label>
                        @endforeach
                    </div>

                </div>
            @endforeach

            {{-- Botón enviar --}}
            <div class="flex justify-end mt-6">
                <button type="submit"
                        class="px-8 py-3 text-sm font-semibold text-white transition-colors duration-200 rounded-lg"
                        style="background-color: #1A3A5C;"
                        onmouseover="this.style.backgroundColor='#2E74B5'"
                        onmouseout="this.style.backgroundColor='#1A3A5C'"
                        onclick="return confirm('¿Está seguro que desea enviar la evaluación? No podrá modificar sus respuestas.')">
                    Enviar evaluación
                </button>
            </div>

        </form>

    </div>

@endsection
