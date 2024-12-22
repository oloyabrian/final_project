<?php

namespace App\Filament\App\Resources\CommunionResource\Pages;

use App\Filament\App\Resources\CommunionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditCommunion extends EditRecord
{
    protected static string $resource = CommunionResource::class;

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
                ->title('Communion details saved.')
                ->body('The detail is successfully saved to the database');
    }
}
