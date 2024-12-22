<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\ConfirmationResource\Pages;
use App\Filament\App\Resources\ConfirmationResource\RelationManagers;
use App\Models\Confirmation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

 


class ConfirmationResource extends Resource
{
    protected static ?string $model = Confirmation::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-arrow-down';
    protected static ?string $navigationGroup = 'Sacrament Management';
    protected static ?string $navigationLabel = 'Confirmation';
    protected static ?string $modelLabel = 'Confirmation';

    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'confirmplace';
    public static function getGlobalSearchResultTitle (Model $record): string
    {
        return $record->person->sname;
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['person.sname',
        'person.cname',
        'person.village',
        'person.oname',
        'confirmplace',
        'person.address'];
    }
    public static function getGlobalSearchQuery(): Builder
    {
        return static::getModel()::query()
            ->where(function (Builder $query) {
                $query->whereHas('person', function (Builder $query) {
                    $search = request()->input('search');
                    $query->whereFullName($search)
                          ->orWhere('sname', 'like', "%{$search}%")
                          ->orWhere('cname', 'like', "%{$search}%");
                })
                ->orWhere('confirmplace', 'like', "%{$search}%")
                ->orWhere('person.address', 'like', "%{$search}%")
                ->orWhere('person.village', 'like', "%{$search}%");
            });
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('person_id')
               ->relationship(name: 'person', titleAttribute: 'cname')
               ->native(false)
               ->label('Person ID')
               ->preload()
               ->searchable()
                ->label('Person ID')
                ->required(),
                Forms\Components\DatePicker::make('confirmdate')
                    ->required()
                    ->displayFormat('d/m/Y')
                    ->Native(false)
                    ->label('Date'),
                Forms\Components\TextInput::make('confirmplace')
                    ->required()
                    ->label('Place')
                    ->maxLength(255),
                    Forms\Components\Select::make('person_id')
               ->relationship(name: 'person', titleAttribute: 'cname')
                    ->native(false)
                    ->preload()
               ->searchable()
                        ->label('Person Name')
                        ->required(), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('person.full_name')  // Use the accessor
                    ->label('Full Name')
                    ->searchable(['sname', 'cname'], function (Builder $query, string $search): Builder {
                        return $query->whereHas('person', function (Builder $query) use ($search) {
                            return $query->whereFullName($search);
                        });
                    }),
                Tables\Columns\TextColumn::make('confirmdate')
                ->date('d/m/Y')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('confirmplace')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('pdf')
                ->icon('heroicon-o-document-arrow-down')
                ->url(fn (Confirmation $record)=>route('confirmation.pdf', $record))
                ->openUrlInNewTab(),
                Tables\Actions\DeleteAction::make()
                ->successNotification(Notification::make()
                ->success()
                ->title('Confirmation details deleted.')
                ->body('The detail is successfully deleted from the database')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function Infolist(Infolist $infolist): Infolist
    {
        return $infolist
            //->record($this->confirmation)
            ->schema([
                Section::make('Confirmation Details')
                    ->columns([
                        'sm' => 3,
                        'xl' => 6,
                        '2xl' => 8,
                    ])
                    ->schema([
                        TextEntry::make('person.full_name')->label('Name'),
                        TextEntry::make('confirmdate')->label('Date'),
                        TextEntry::make('confirmplace')->label('Place'),
                        TextEntry::make('person_id')->label('ID'),
                        TextEntry::make('created_at')->label('Created At'),
                        TextEntry::make('updated_at')->label('Updated At'),
                    ])
                    ->columnSpan([
                        'sm' => 2,
                        'xl' => 3,
                        '2xl' => 4,
                    ]),
            ]);
    
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

   
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConfirmations::route('/'),
            'create' => Pages\CreateConfirmation::route('/create'),
           // 'view' => Pages\ViewConfirmation::route('/{record}'),
            'edit' => Pages\EditConfirmation::route('/{record}/edit'),
        ];
    }
}
