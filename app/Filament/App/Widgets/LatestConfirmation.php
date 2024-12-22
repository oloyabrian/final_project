<?php

namespace App\Filament\App\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Confirmation;
use Filament\Tables\Columns\TextColumn;

class LatestConfirmation extends BaseWidget
{
    protected int | string| array $columnSpan= 'full';
        protected static ?int $sort = 4;
    public function table(Table $table): Table
    {
          return $table
                ->query(Confirmation::query())
                ->defaultSort('created_at', 'DESC')
                ->columns([
                    TextColumn::make('person.cname')->label('Christian Name') ->searchable(),
                    TextColumn::make('person.sname')->label('Surname') ->searchable(),
                    TextColumn::make('confirplace')->label('Place') ->searchable(),
                    TextColumn::make('confirmdate')->label('Date') ->searchable(),
                    
                ]);
    }
}
