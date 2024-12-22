<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Ordination;
use Filament\Tables\Columns\TextColumn;

class LatestAdminOrdination extends BaseWidget
{
    protected int | string| array $columnSpan= 'full';
    protected static ?int $sort = 15;
    public function table(Table $table): Table
    {
          return $table
                ->query(Ordination::query())
                ->defaultSort('created_at', 'DESC')
                ->columns([
                    TextColumn::make('person.cname')->label('Christian Name') ->searchable(),
                    TextColumn::make('person.sname')->label('Surname') ->searchable(),
                    TextColumn::make('ord_date')->label('Date') ->searchable(),
                    TextColumn::make('minister')->label('Minister') ->searchable(),
                                        
                ]);
            }
}
