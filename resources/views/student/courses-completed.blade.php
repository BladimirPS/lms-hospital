@extends('layouts.student')

@section('content')

    <div class="mb-6">
        <a href="{{ route('student.dashboard') }}"
           class="inline-block mb-2 text-xs text-gray-400 hover:text-gray-600">
            ← Volver al inicio
        </a>
        <h1 class="text-2xl font-bold" style="color: #1A3A5C;">Cursos completados</h1>
        <p class="mt-1 text-sm text-gray-500">Cursos que has finalizado exitosamente.</p>
    </div>

    @forelse($enrollments as $enrollment)
        <div class="flex items-center justify-between p-6 mb-4 bg-white shadow-sm rounded-xl">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full"
                          style="background-color: #EBF3FB; color: #1A3A5C;">
                        {{ $enrollment->course->type === 'talk' ? 'Charla' : 'Taller' }}
                    </span>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full"
                          style="background-color: #EDFAF1; color: #27AE60;">
                        ✓ Completado
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
    @empty
        <div class="p-6 text-sm text-center text-gray-400 bg-white shadow-sm rounded-xl">
            Aún no has completado ningún curso.
        </div>
    @endforelse

@endsection
