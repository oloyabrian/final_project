<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\PersonResource\Pages;
use App\Filament\App\Resources\PersonResource\RelationManagers;
use App\Models\Person;
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
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Infolists\Components\Tabs;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;





class PersonResource extends Resource
{
    protected static ?string $model = Person::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationGroup = 'Cristians Management';
    protected static ?string $navigationLabel = 'Christians';
  
   protected static ?string $modelLabel = 'Christians';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'cname';
    public static function getGlobalSearchResultTitle (Model $record): string
    {
        return $record->sname;
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['fname', 'sname', 'oname', 'village', 'address','mname', 'fname'];
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
                Forms\Components\Section::make('Person Details')
                ->description('Enter user details here')
                ->schema([
            Forms\Components\TextInput::make('cname')
                    ->required()
                    ->label('Christian Name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('sname')
                    ->required()
                    ->label('Surname')
                    ->maxLength(255),
                Forms\Components\TextInput::make('oname')
                    ->maxLength(255)
                    ->label('Other Name')
                    ->default(null),
               
                
                    Forms\Components\Select::make('gender')
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                    ])
                    ->native(false)
                   ->label('Gender'),
                Forms\Components\DatePicker::make('dob')
                ->label('Date of Birth')
                ->native(false)
                ->displayFormat('d/m/Y')
                ->columnSpan('full')
               ->required(),
                    ])->columns(2),
                    Forms\Components\Section::make('Parents Details')
                    ->description('Enter the details of the parents here')
                    ->schema([
                Forms\Components\TextInput::make('fname')
                ->label('Father Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mname')
                    ->required()
                    ->label('Mother Name')
                    ->maxLength(255),
                    ])->columns(2),
                    Forms\Components\Section::make('Contact Details')
                    ->description('Enter the following fields accordingly')
                    ->Schema([
                        Forms\Components\TextInput::make('village')
                        ->label('Village')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tel')
                        ->label('Phone Number')
                            ->tel()
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('address')
                        ->label('Address')
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('email')
                        ->label('Email')
                            ->email()
                            ->maxLength(255)
                            ->default(null),
                    ])->columns(2),
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cname')
                ->label('Christian Name')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('sname')
                ->label('Surname')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('oname')
                ->label('Other Name')
                ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('gender')
                ->label('Gender')
                ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->label('Date of Birth')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('fname')
                ->label('Father Name')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('mname')
                ->label('Mother Name')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('village')
                ->label('Village')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tel')
                ->label('Phone Number')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('address')
                ->label('Address')
                ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email')
                ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                SelectFilter::make('gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    //'published' => 'Published',
                ])
                ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('pdf')
                ->icon('heroicon-o-document-arrow-down')
                ->url(fn (Person $record)=>route('person.pdf', $record))
                ->openUrlInNewTab(),
                Tables\Actions\DeleteAction::make()->successNotification(Notification::make()
                ->success()
                ->title('Persons details created.')
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
                Section::make('Person Details')
                    ->columns([
                        'sm' => 3,
                        'xl' => 6,
                        '2xl' => 8,
                    ])

                    ->schema([
                        TextEntry::make('cname')->label('Christian Name'),
                        TextEntry::make('sname')->label('Surname'),
                        TextEntry::make('oname')->label('Other Name'),
                        TextEntry::make('gender')->label('Gender'),
                        TextEntry::make('dob')->label('Date of Birth'),
                        TextEntry::make('fname')->label('Father'),
                        TextEntry::make('mname')->label('Mother'),
                        TextEntry::make('village')->label('Village'), 
                        TextEntry::make('tel')->label('Telephone'),
                        TextEntry::make('email')->label('Email'), 
                        TextEntry::make('address')->label('Address'), 
                        TextEntry::make('created_at')->label('Created At'),
                        TextEntry::make('updated_at')->label('Update At'),
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
            'index' => Pages\ListPeople::route('/'),
            'create' => Pages\CreatePerson::route('/create'),
            //'view' => Pages\ViewPerson::route('/{record}'),
            'edit' => Pages\EditPerson::route('/{record}/edit'),
        ];
    }
}
