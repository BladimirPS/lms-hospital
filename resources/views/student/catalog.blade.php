@extends('layouts.student')

@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold" style="color: #1A3A5C;">Catálogo de cursos</h1>
        <p class="mt-1 text-sm text-gray-500">Cursos de libre elección disponibles para todos los empleados.</p>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($courses as $course)
            <div class="overflow-hidden bg-white shadow-sm rounded-xl">

                {{-- Imagen de portada --}}
                @if($course->cover_image)
                    <img src="{{ Storage::url($course->cover_image) }}" class="object-cover w-full h-40">
                @else
                    <div class="flex items-center justify-center w-full h-40" style="background-color: #EBF3FB;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" style="color: #1A3A5C;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                @endif

                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full"
                            style="background-color: #EBF3FB; color: #1A3A5C;">
                            {{ $course->type === 'talk' ? 'Charla' : 'Taller' }}
                        </span>
                    </div>

                    <h3 class="mb-1 font-semibold text-gray-800">{{ $course->title }}</h3>
                    <p class="mb-4 text-xs text-gray-400 line-clamp-2">{{ $course->description }}</p>

                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400">
                            Nota mínima: {{ $course->minimum_score }}%
                        </span>
                        <form method="POST" action="{{ route('student.catalog.enroll', $course) }}">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white transition-colors duration-200 rounded-lg"
                                style="background-color: #1A3A5C;" onmouseover="this.style.backgroundColor='#2E74B5'"
                                onmouseout="this.style.backgroundColor='#1A3A5C'">
                                Inscribirse
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 p-6 text-sm text-center text-gray-400 bg-white shadow-sm rounded-xl">
                No hay cursos de libre elección disponibles en este momento.
            </div>
        @endforelse
    </div>

@endsection
