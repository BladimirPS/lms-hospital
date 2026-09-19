@extends('layouts.student')

@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold" style="color: #1A3A5C;">Mis diplomas</h1>
        <p class="mt-1 text-sm text-gray-500">Diplomas obtenidos por completar cursos del hospital.</p>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        @forelse($diplomas as $enrollment)
            <div class="flex items-center justify-between p-6 bg-white shadow-sm rounded-xl">
                <div>
                    <span class="inline-block px-2 py-1 mb-2 text-xs font-semibold rounded-full"
                          style="background-color: #EBF3FB; color: #1A3A5C;">
                        {{ $enrollment->course->type === 'talk' ? 'Charla' : 'Taller' }}
                    </span>
                    <h3 class="font-semibold text-gray-800">{{ $enrollment->course->title }}</h3>
                    <p class="mt-1 text-xs text-gray-400">
                        Emitido el {{ $enrollment->diploma->issued_at->format('d/m/Y') }}
                    </p>
                    <p class="text-xs text-gray-400">
                        Código: {{ $enrollment->diploma->diploma_code }}
                    </p>
                    <p class="text-xs text-gray-400">
                        Calificación: {{ $enrollment->diploma->obtained_score }}%
                    </p>
                </div>
                @if($enrollment->diploma->pdf_path)
                    <a href="{{ Storage::url($enrollment->diploma->pdf_path) }}"
                       target="_blank"
                       class="px-4 py-2 text-sm font-medium transition-colors duration-200 border rounded-lg"
                       style="border-color: #1A3A5C; color: #1A3A5C;">
                        Descargar
                    </a>
                @else
                    <span class="text-xs text-gray-400">No disponible</span>
                @endif
            </div>
        @empty
            <div class="col-span-2 p-6 text-sm text-center text-gray-400 bg-white shadow-sm rounded-xl">
                Aún no tienes diplomas obtenidos.
            </div>
        @endforelse
    </div>

@endsection
