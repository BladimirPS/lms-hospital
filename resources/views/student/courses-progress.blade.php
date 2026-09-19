@extends('layouts.student')

@section('content')

    <div class="mb-6">
        <a href="{{ route('student.dashboard') }}"
           class="inline-block mb-2 text-xs text-gray-400 hover:text-gray-600">
            ← Volver al inicio
        </a>
        <h1 class="text-2xl font-bold" style="color: #1A3A5C;">Cursos en progreso</h1>
        <p class="mt-1 text-sm text-gray-500">Cursos que tienes pendientes de completar.</p>
    </div>

    @forelse($enrollments as $enrollment)
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
                <div class="mt-3">
                    <div class="flex justify-between mb-1 text-xs text-gray-500">
                        <span>Progreso</span>
                        <span>{{ $enrollment->progress }}%</span>
                    </div>
                    <div class="w-full h-2 bg-gray-200 rounded-full">
                        <div class="h-2 rounded-full"
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
            No tienes cursos en progreso en este momento.
        </div>
    @endforelse

@endsection
