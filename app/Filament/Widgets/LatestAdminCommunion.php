<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Communion;
use Filament\Tables\Columns\TextColumn;
        

class LatestAdminCommunion extends BaseWidget
{
    protected int | string| array $columnSpan= 'full';
    protected static ?int $sort = 12;
    public function table(Table $table): Table
    {
       return $table
                    ->query(Communion::query())
                    ->defaultSort('created_at', 'DESC')
                    ->columns([
                        TextColumn::make('person.cname')->label('Christian Name') ->searchable(),
                        TextColumn::make('person.sname')->label('Surname') ->searchable(),
                        TextColumn::make('cplace')->label('Place') ->searchable(),
                        TextColumn::make('cdate')->label('Date') ->searchable(),
                        
                    ]);
            }
        }
        