<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            width: 279mm;
            height: 215mm;
            font-family: 'DejaVu Sans', sans-serif;
        }

        .diploma {
            width: 279mm;
            height: 215mm;
            position: relative;
            overflow: hidden;
        }

        .bg {
            position: absolute;
            top: 0; left: 0;
            width: 279mm;
            height: 215mm;
        }

        /* Logo HRO */
        .logo {
            position: absolute;
            top: -5%;
            left: 50%;
            margin-left: -100px;
            width: 200px;
        }

        /* Título */
        .titulo-diploma {
            position: absolute;
            top: 16%;
            left: 0; right: 0;
            text-align: center;
            font-size: 40px;
            font-weight: bold;
            color: #1A3A5C;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        /* Certifica que */
        .certifica {
            position: absolute;
            top: 24%;
            left: 0; right: 0;
            text-align: center;
            font-size: 20px;
            color: #555;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Nombre del empleado */
        .employee-name {
            position: absolute;
            top: 29%;
            left: 0; right: 0;
            text-align: center;
            font-size: 50px;
            font-weight: bold;
            font-style: italic;
            color: #1A3A5C;
        }

        /* Línea bajo el nombre */
        .name-line {
            position: absolute;
            top: 37%;
            left: 20%; right: 20%;
            height: 1px;
            background: #1A3A5C;
        }

        /* Texto participación */
        .participated {
            position: absolute;
            top: 39%;
            left: 0; right: 0;
            text-align: center;
            font-size: 18px;
            color: #555;
        }

        /* Nombre del curso */
        .course-name {
            position: absolute;
            top: 44%;
            left: 5%; right: 5%;
            text-align: center;
            font-size: 35px;
            font-weight: bold;
            font-style: italic;
            color: #1A3A5C;
            line-height: 1.3;
        }

        /* Texto reconocimiento */
        .reconocimiento {
            position: absolute;
            top: 54%;
            left: 8%; right: 8%;
            text-align: center;
            font-size: 18px;
            color: #555;
            line-height: 1.5;
        }

        /* Fecha */
        .date-line {
            position: absolute;
            top: 63%;
            left: 0; right: 0;
            text-align: center;
            font-size: 18px;
            color: #333;
        }

        /* Firma izquierda */
        .sig-left {
            position: absolute;
            top: 74%;
            left: 25%;
            width: 150px;
            text-align: center;
        }

        /* Firma derecha */
        .sig-right {
            position: absolute;
            top: 74%;
            right: 25%;
            width: 150px;
            text-align: center;
        }

        .sig-img {
            height: 38px;
            margin-bottom: 2px;
        }

        .sig-spacer {
            height: 38px;
        }

        .sig-line {
            border-top: 1px solid #1A3A5C;
            padding-top: 4px;
            margin-top: 2px;
        }

        .sig-name {
            font-size: 14px;
            font-weight: bold;
            color: #1A3A5C;
        }

        .sig-title {
            font-size: 12px;
            color: #555;
        }

        /* Nota y código */

        .code-line {
            position: absolute;
            top: 92%;
            left: 0; right: 0;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            color: #1A3A5C;
        }
    </style>
</head>
<body>
    <div class="diploma">

        {{-- Imagen de fondo --}}
        @php
            $isPreview = request()->is('diploma-preview');
            $bgSrc = $isPreview
                ? asset('img/diploma.png')
                : public_path('img/diploma.png');
        @endphp
        <img src="{{ $bgSrc }}" class="bg" alt="Fondo">

        {{-- Logo HRO --}}
        @php
            $logoSrc = $isPreview
                ? asset('img/logo-hro-azul.png')
                : public_path('img/logo-hro-azul.png');
        @endphp
        <img src="{{ $logoSrc }}" class="logo" alt="HRO">

        {{-- Título --}}
        <div class="titulo-diploma">Diploma de Capacitación</div>

        {{-- Certifica que --}}
        <div class="certifica">Certifica que:</div>

        {{-- Nombre del empleado --}}
        <div class="employee-name">
            {{ $enrollment->user->first_name }}
            {{ $enrollment->user->middle_name }}
            {{ $enrollment->user->last_name }}
            {{ $enrollment->user->second_last_name }}
        </div>

        {{-- Línea decorativa --}}
        <div class="name-line"></div>

        {{-- Texto participación --}}
        <div class="participated">
            Ha participado y aprobado satisfactoriamente el curso de capacitación:
        </div>

        {{-- Nombre del curso --}}
        <div class="course-name">
            {{ $enrollment->course->title }}
        </div>

        {{-- Reconocimiento --}}
        <div class="reconocimiento">
            En reconocimiento a su dedicación y esfuerzo en el fortalecimiento<br>
            de sus competencias profesionales al servicio de la salud.
        </div>

        {{-- Fecha --}}
        <div class="date-line">
            Quetzaltenango, Guatemala, {{ \Carbon\Carbon::parse($diploma->issued_at)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}.
        </div>

        {{-- Firma izquierda (Director) --}}
        <div class="sig-left">
            @if($settings && $settings->director_signature && file_exists(storage_path('app/public/' . $settings->director_signature)))
                @php
                    $sigDirSrc = $isPreview
                        ? Storage::url($settings->director_signature)
                        : storage_path('app/public/' . $settings->director_signature);
                @endphp
                <img src="{{ $sigDirSrc }}" class="sig-img" alt="Firma">
            @else
                <div class="sig-spacer"></div>
            @endif
            <div class="sig-line">
                <p class="sig-name">{{ $settings->director_name ?? 'Director Ejecutivo' }}</p>
                <p class="sig-title">{{ $settings->director_title ?? 'Director Ejecutivo' }}</p>
            </div>
        </div>

        {{-- Firma derecha (RRHH) --}}
        <div class="sig-right">
            @if($settings && $settings->hr_signature && file_exists(storage_path('app/public/' . $settings->hr_signature)))
                @php
                    $sigHrSrc = $isPreview
                        ? Storage::url($settings->hr_signature)
                        : storage_path('app/public/' . $settings->hr_signature);
                @endphp
                <img src="{{ $sigHrSrc }}" class="sig-img" alt="Firma">
            @else
                <div class="sig-spacer"></div>
            @endif
            <div class="sig-line">
                <p class="sig-name">{{ $settings->hr_name ?? 'Coordinador de RRHH' }}</p>
                <p class="sig-title">{{ $settings->hr_title ?? 'Coordinación de RRHH' }}</p>
            </div>
        </div>



        {{-- Código --}}
        <div class="code-line">
            Código de verificación: {{ $diploma->diploma_code }}
        </div>

    </div>
</body>
</html>
