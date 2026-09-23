<?php

namespace App\Filament\Admin\Resources\Courses\Pages;

use App\Filament\Admin\Resources\Courses\CourseResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

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
        if ($this->record->status === 'published') {
            $this->record->createEnrollmentsForSections();
        }
    }
}
