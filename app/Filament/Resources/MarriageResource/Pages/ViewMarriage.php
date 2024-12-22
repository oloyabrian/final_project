<?php

namespace App\Filament\Resources\MarriageResource\Pages;

use App\Filament\Resources\MarriageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMarriage extends ViewRecord
{
    protected static string $resource = MarriageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
