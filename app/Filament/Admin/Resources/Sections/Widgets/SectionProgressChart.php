<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Section;
use Filament\Widgets\ChartWidget;

class SectionProgressChart extends ChartWidget
{
    protected ?string $heading = 'Avance de Acreditación por Sección';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $sections = Section::withCount('users')
            ->with(['users.enrollments' => fn ($q) => $q->where('status', 'completed')])
            ->get();

        $labels = [];
        $data = [];

        foreach ($sections as $section) {
            $totalUsers = $section->users_count;
            $completedCount = $section->users->sum(fn ($u) => $u->enrollments->count());
            $pct = $totalUsers > 0 ? round(($completedCount / $totalUsers) * 100, 1) : 0;

            $labels[] = $section->name;
            $data[] = $pct;
        }

        return [
            'datasets' => [[
                'label' => '% Acreditación',
                'data' => $data,
                'backgroundColor' => '#2E74B5',
            ]],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
