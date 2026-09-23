<div style="display: flex; gap: 16px; min-height: 400px;">

    {{-- Sidebar izquierdo --}}
    <div style="width: 260px; flex-shrink: 0; background: #F5F7FA; border-radius: 8px; padding: 16px;">
        <h3 style="font-weight: bold; font-size: 14px; color: #1A3A5C; margin-bottom: 8px;">
            Contenido del curso
        </h3>

        {{-- Barra de progreso --}}
        <div style="margin-bottom: 16px;">
            <div style="display: flex; justify-content: space-between; font-size: 11px; color: #6B7280; margin-bottom: 4px;">
                <span>Progreso</span><span>0%</span>
            </div>
            <div style="background: #E5E7EB; border-radius: 9999px; height: 6px;">
                <div style="width: 0%; background: #1A3A5C; border-radius: 9999px; height: 6px;"></div>
            </div>
        </div>

        {{-- Módulos --}}
@if($course->modules->isEmpty())
    <p style="font-size: 12px; color: #9CA3AF;">Sin módulos aún.</p>
@else
    @foreach($course->modules->sortBy('order') as $module)
        <div style="margin-bottom: 12px;">
            <p style="font-size: 10px; font-weight: 600; color: #6B7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px;">
                {{ $module->title }}
            </p>
            <ul style="list-style: none; padding: 0; margin: 0;">
                @foreach($module->lessons->sortBy('order') as $lesson)
                    <li style="display: flex; align-items: center; gap: 8px; padding: 6px 8px; border-radius: 6px; font-size: 12px; color: #4B5563; margin-bottom: 2px;">
                        <span style="width: 12px; height: 12px; border-radius: 50%; border: 1.5px solid #D1D5DB; display: inline-block; flex-shrink: 0;"></span>
                        {{ $lesson->title }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
@endif

        {{-- Botón evaluación --}}
        <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #E5E7EB;">
            <button disabled style="width: 100%; padding: 8px; border-radius: 8px; font-size: 12px; font-weight: 500; background: #E5E7EB; color: #9CA3AF; cursor: not-allowed;">
                Complete todas las lecciones para continuar
            </button>
        </div>
    </div>

    {{-- Contenido principal --}}
    <div style="flex: 1;">

        {{-- Título del curso --}}
        <h2 style="font-size: 20px; font-weight: bold; color: #1A3A5C; margin-bottom: 16px;">
            {{ $course->title }}
        </h2>

        {{-- Primera lección --}}
        @php
            $firstLesson = $course->modules->sortBy('order')->first()?->lessons->sortBy('order')->first();
        @endphp

        @if($firstLesson)
            <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 16px; font-weight: 600; color: #1F2937; margin-bottom: 16px;">
                    {{ $firstLesson->title }}
                </h3>

                @if($firstLesson->type === 'youtube_video')
                    @php
                        preg_match('/(?:v=|youtu\.be\/)([^&\s]+)/', $firstLesson->youtube_url ?? '', $matches);
                        $videoId = $matches[1] ?? null;
                    @endphp
                    @if($videoId)
                        <div style="aspect-ratio: 16/9; margin-bottom: 16px;">
                            <iframe style="width: 100%; height: 100%; border-radius: 8px;"
                                    src="https://www.youtube.com/embed/{{ $videoId }}"
                                    frameborder="0" allowfullscreen>
                            </iframe>
                        </div>
                    @endif

                @elseif($firstLesson->type === 'server_video')
                    <video controls style="width: 100%; border-radius: 8px; margin-bottom: 16px;">
                        <source src="{{ Storage::disk('public')->url($firstLesson->file_path) }}" type="video/mp4">
                    </video>

                @elseif($firstLesson->type === 'pdf')
                    <iframe src="{{ Storage::disk('public')->url($firstLesson->file_path) }}"
                            style="width: 100%; height: 400px; border-radius: 8px; margin-bottom: 16px;">
                    </iframe>

                @elseif($firstLesson->type === 'article')
                    <div class="article-content" style="margin-bottom: 16px;">
                        {!! $firstLesson->content !!}
                    </div>
                @endif

                @if($firstLesson->description)
                    <p style="font-size: 13px; color: #6B7280;">{{ $firstLesson->description }}</p>
                @endif

                {{-- Navegación --}}
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 16px; padding-top: 16px; border-top: 1px solid #F3F4F6;">
                    <span style="font-size: 12px; color: #9CA3AF;">✓ Lección marcada como vista automáticamente</span>
                    <button style="padding: 8px 16px; background: #1A3A5C; color: white; border-radius: 8px; font-size: 13px; font-weight: 500; border: none; cursor: pointer;">
                        Siguiente lección →
                    </button>
                </div>
            </div>
        @else
            <div style="background: white; border-radius: 12px; padding: 20px; text-align: center; color: #9CA3AF;">
                Este curso aún no tiene lecciones.
            </div>
        @endif
    </div>

</div>
