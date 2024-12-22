<?php

namespace App\Filament\Resources\MarriageResource\Pages;

use App\Filament\Resources\MarriageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditMarriage extends EditRecord
{
    protected static string $resource = MarriageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function getSavedNotification(): Notification
    {
        return Notification::make()
                ->success()
                ->title('Marriage details saved.')
                ->body('The detail is successfully saved to the database');
    }
}
