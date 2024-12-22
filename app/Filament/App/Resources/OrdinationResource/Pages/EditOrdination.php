<?php

namespace App\Filament\App\Resources\OrdinationResource\Pages;

use App\Filament\App\Resources\OrdinationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;


class EditOrdination extends EditRecord
{
    protected static string $resource = OrdinationResource::class;

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
                ->title('Ordination details saved.')
                ->body('The detail is successfully saved to the database');
    }
}

