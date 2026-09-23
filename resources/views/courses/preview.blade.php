<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista previa — {{ $course->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color: #F5F7FA;" class="font-sans antialiased">

    {{-- Banner de preview --}}
    <div class="py-2 text-sm font-medium text-center"
         style="background-color: #FFF3E0; color: #E67E22; border-bottom: 2px solid #E67E22;">
        ⚠️ Vista previa — Así verá el empleado este curso
    </div>

    <div class="flex gap-6 p-6 mx-auto max-w-7xl">

        {{-- Sidebar --}}
        <div class="flex-shrink-0 w-72">
            <div class="sticky p-5 bg-white shadow-sm rounded-xl top-6">
                <h2 class="mb-1 text-sm font-bold" style="color: #1A3A5C;">Contenido del curso</h2>

                {{-- Barra de progreso --}}
                <div class="mb-4">
                    <div class="flex justify-between mb-1 text-xs text-gray-500">
                        <span>Progreso</span><span id="progress-text">0%</span>
                    </div>
                    <div class="w-full h-2 bg-gray-200 rounded-full">
                        <div id="progress-bar" class="h-2 transition-all duration-300 rounded-full"
                             style="width: 0%; background-color: #1A3A5C;"></div>
                    </div>
                </div>

                {{-- Módulos y lecciones --}}
                @foreach($course->modules->sortBy('order') as $module)
                    <div class="mb-3">
                        <p class="mb-2 text-xs font-semibold tracking-wide text-gray-500 uppercase">
                            {{ $module->title }}
                        </p>
                        <ul class="space-y-1">
                            @foreach($module->lessons->sortBy('order') as $lesson)
                                <li>
                                    <button onclick="showLesson({{ $lesson->id }})"
                                            id="sidebar-{{ $lesson->id }}"
                                            class="flex items-center w-full gap-2 px-3 py-2 text-xs text-left text-gray-600 transition-colors duration-200 rounded-lg hover:bg-gray-100">
                                        <span id="check-{{ $lesson->id }}"
                                              class="flex-shrink-0 w-3 h-3 border border-gray-300 rounded-full">
                                        </span>
                                        {{ $lesson->title }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

                {{-- Botón evaluación --}}
                <div class="pt-4 mt-4 border-t border-gray-100">
                    <button id="btn-exam" disabled
                            class="w-full px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        Complete todas las lecciones para continuar
                    </button>
                </div>
            </div>
        </div>

        {{-- Contenido principal --}}
        <div class="flex-1">
            <a href="javascript:history.back()"
               class="inline-block mb-4 text-xs text-gray-400 hover:text-gray-600">
                ← Volver
            </a>
            <h1 class="mb-6 text-2xl font-bold" style="color: #1A3A5C;">{{ $course->title }}</h1>

            {{-- Contenedor de lección activa --}}
            <div id="lesson-container" class="p-6 bg-white shadow-sm rounded-xl">
                <p class="text-sm text-center text-gray-400">Selecciona una lección para comenzar.</p>
            </div>
        </div>

    </div>

    {{-- Datos de lecciones en JSON --}}
    <script>
        const lessons = {
            @foreach($course->modules->sortBy('order') as $module)
                @foreach($module->lessons->sortBy('order') as $lesson)
                {{ $lesson->id }}: {
                    title: @json($lesson->title),
                    type: @json($lesson->type),
                    content: @json($lesson->content),
                    file_path: @json($lesson->file_path ? Storage::disk('public')->url($lesson->file_path) : null),
                    youtube_url: @json($lesson->youtube_url),
                    description: @json($lesson->description),
                },
                @endforeach
            @endforeach
        };

        const totalLessons = Object.keys(lessons).length;
        const viewed = new Set();
        let currentLesson = null;

        function showLesson(id) {
            const lesson = lessons[id];
            if (!lesson) return;

            currentLesson = id;

            // Marcar activo en sidebar
            document.querySelectorAll('[id^="sidebar-"]').forEach(el => {
                el.style.backgroundColor = '';
                el.style.color = '';
            });
            const activeBtn = document.getElementById('sidebar-' + id);
            if (activeBtn) {
                activeBtn.style.backgroundColor = '#1A3A5C';
                activeBtn.style.color = 'white';
            }

            // Marcar como vista
            viewed.add(id);
            updateProgress();

            // Checkmark
            const check = document.getElementById('check-' + id);
            if (check) {
                check.style.backgroundColor = '#27AE60';
                check.style.borderColor = '#27AE60';
            }

            // Renderizar contenido
            let html = `<h2 style="font-size: 16px; font-weight: 600; color: #1F2937; margin-bottom: 16px;">${lesson.title}</h2>`;

            if (lesson.type === 'server_video' && lesson.file_path) {
                html += `<video controls style="width: 100%; border-radius: 8px; margin-bottom: 16px;">
                            <source src="${lesson.file_path}" type="video/mp4">
                         </video>`;
            } else if (lesson.type === 'youtube_video' && lesson.youtube_url) {
                const match = lesson.youtube_url.match(/(?:v=|youtu\.be\/)([^&\s]+)/);
                if (match) {
                    html += `<div style="aspect-ratio: 16/9; margin-bottom: 16px;">
                                <iframe style="width: 100%; height: 100%; border-radius: 8px;"
                                        src="https://www.youtube.com/embed/${match[1]}"
                                        frameborder="0" allowfullscreen></iframe>
                             </div>`;
                }
            } else if (lesson.type === 'pdf' && lesson.file_path) {
                html += `<iframe src="${lesson.file_path}" style="width: 100%; height: 400px; border-radius: 8px; margin-bottom: 16px;"></iframe>`;
            } else if (lesson.type === 'article' && lesson.content) {
                html += `<div class="article-content" style="margin-bottom: 16px;">${lesson.content}</div>`;
            }

            if (lesson.description) {
                html += `<p style="font-size: 13px; color: #6B7280; margin-bottom: 16px;">${lesson.description}</p>`;
            }

            // Navegación
            const lessonIds = Object.keys(lessons).map(Number);
            const currentIndex = lessonIds.indexOf(id);
            const nextId = lessonIds[currentIndex + 1];

            html += `<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 16px; padding-top: 16px; border-top: 1px solid #F3F4F6;">
                        <span style="font-size: 12px; color: #9CA3AF;">✓ Lección marcada como vista</span>`;

            if (nextId) {
                html += `<button onclick="showLesson(${nextId})"
                                 style="padding: 8px 16px; background: #1A3A5C; color: white; border-radius: 8px; font-size: 13px; font-weight: 500; border: none; cursor: pointer;">
                             Siguiente lección →
                         </button>`;
            }

            html += `</div>`;

            document.getElementById('lesson-container').innerHTML = html;
        }

        function updateProgress() {
            const pct = totalLessons > 0 ? Math.round((viewed.size / totalLessons) * 100) : 0;
            document.getElementById('progress-bar').style.width = pct + '%';
            document.getElementById('progress-text').textContent = pct + '%';

            if (pct === 100) {
                const btn = document.getElementById('btn-exam');
                btn.disabled = false;
                btn.style.backgroundColor = '#27AE60';
                btn.style.color = 'white';
                btn.style.cursor = 'pointer';
                btn.textContent = 'Ir a la evaluación final ✓';
            }
        }

        // Cargar primera lección automáticamente
        const firstId = Object.keys(lessons)[0];
        if (firstId) showLesson(parseInt(firstId));
    </script>

</body>
</html>
