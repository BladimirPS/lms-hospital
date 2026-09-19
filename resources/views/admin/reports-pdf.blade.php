<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte LMS — HGO</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        h1 { color: #1A3A5C; font-size: 18px; margin-bottom: 4px; }
        h2 { color: #1A3A5C; font-size: 14px; margin-top: 20px; margin-bottom: 8px; }
        p { margin: 2px 0; color: #666; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th { background-color: #1A3A5C; color: white; padding: 6px 8px; text-align: left; font-size: 11px; }
        td { padding: 5px 8px; border-bottom: 1px solid #eee; font-size: 11px; }
        tr:nth-child(even) { background-color: #f5f7fa; }
        .stats { display: table; width: 100%; margin-bottom: 20px; }
        .stat { display: table-cell; text-align: center; padding: 12px; background-color: #EBF3FB; border-radius: 6px; margin: 4px; }
        .stat-number { font-size: 22px; font-weight: bold; color: #1A3A5C; }
        .stat-label { font-size: 10px; color: #666; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #999; }
    </style>
</head>
<body>

    <h1>Reporte General — Sistema LMS</h1>
    <p>Hospital General de Occidente — Quetzaltenango</p>
    <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>

    <h2>Resumen estadístico</h2>
    <table>
        <tr>
            <th>Indicador</th>
            <th>Valor</th>
        </tr>
        <tr>
            <td>Total de empleados registrados</td>
            <td>{{ $totalUsers }}</td>
        </tr>
        <tr>
            <td>Total de inscripciones completadas</td>
            <td>{{ $totalCompleted }}</td>
        </tr>
        <tr>
            <td>Total de diplomas emitidos</td>
            <td>{{ $totalDiplomas }}</td>
        </tr>
    </table>

    <h2>Progreso por curso</h2>
    <table>
        <thead>
            <tr>
                <th>Curso</th>
                <th>Tipo</th>
                <th>Inscritos</th>
                <th>Completados</th>
                <th>Cobertura</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courseProgress as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->type === 'talk' ? 'Charla' : 'Taller' }}</td>
                    <td>{{ $course->enrollments_count }}</td>
                    <td>{{ $course->completed_count }}</td>
                    <td>
                        {{ $course->enrollments_count > 0
                            ? round(($course->completed_count / $course->enrollments_count) * 100)
                            : 0 }}%
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Sistema de Gestión de Capacitación — Hospital General de Occidente
    </div>

</body>
</html>
