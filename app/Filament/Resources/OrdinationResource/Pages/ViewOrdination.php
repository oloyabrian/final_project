<?php

namespace App\Filament\Resources\OrdinationResource\Pages;

use App\Filament\Resources\OrdinationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Resources;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Ordination;

class ViewOrdination extends ViewRecord
{
    protected static string $resource = OrdinationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
    
}
