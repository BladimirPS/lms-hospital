<?php

namespace App\Filament\Admin\Resources\Courses\Pages;

use App\Filament\Admin\Resources\Courses\CourseResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use App\Models\Enrollment;

use Filament\Actions\Action;




class EditCourse extends EditRecord
{
    protected static string $resource = CourseResource::class;
    protected static ?string $title = 'Editar curso';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('vista_previa')
                ->label('Vista previa')
                ->icon('heroicon-o-eye')
                ->color('gray')
                ->url(fn() => route('courses.preview', $this->record->id))
                ->openUrlInNewTab(),
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function afterSave(): void
    {


        if ($this->record->status !== 'published') {
            return;
        }

        $course = $this->record->fresh()->load('sections.users');


        $currentSectionIds = $course->sections->pluck('id');

        foreach ($course->sections as $section) {
            foreach ($section->users as $user) {
                Enrollment::firstOrCreate([
                    'user_id'   => $user->id,
                    'course_id' => $course->id,
                ], [
                    'status'      => 'in_progress',
                    'progress'    => 0,
                    'enrolled_at' => now(),
                    'start_date'  => $course->start_date,
                    'due_date'    => $course->due_date,
                ]);
            }
        }


        $enrollmentsToAbandon = Enrollment::where('course_id', $course->id)
            ->where('status', 'in_progress')
            ->whereHas('user', function ($q) use ($currentSectionIds) {
                $q->whereNotIn('section_id', $currentSectionIds);
            })
            ->get();

        foreach ($enrollmentsToAbandon as $enrollment) {
            $enrollment->update(['status' => 'abandoned']);
        }
    }
}
