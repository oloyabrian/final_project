<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Marriage;
use Filament\Tables\Columns\TextColumn;

class LatestAdminMarriage extends BaseWidget
{
    protected int | string| array $columnSpan= 'full';
    protected static ?int $sort = 14;
    public function table(Table $table): Table
    {
          return $table
                ->query(Marriage::query())
                ->defaultSort('created_at', 'DESC')
                ->columns([
                    TextColumn::make('person.cname')->label('Christian Name') ->searchable(),
                    TextColumn::make('person.sname')->label('Surname') ->searchable(),
                    TextColumn::make('spouse')->label('Spouse') ->searchable(),
                    TextColumn::make('marriage_date')->label('Date') ->searchable(),
                    TextColumn::make('matron')->label('Matron') ->searchable(),
                    TextColumn::make('patron')->label('Patron') ->searchable(),
                    
                ]);
    }
}
