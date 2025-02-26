<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Status;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Rotativeline;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\Exports\ExportColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Count;
use App\Filament\Resources\StatusResource\Pages;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StatusResource\RelationManagers;
use App\Filament\Resources\StatusResource\RelationManagers\RotativelineRelationManager;

class StatusResource extends Resource
{
    protected static ?string $model = Status::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('name')
                    ->searchable()
                    ->badge()
                    ->color(function (Status $record): string {
                        if ($record->name === 'CERRADA'){
                            return 'gray';
                        }
                        if ($record->name === 'MORA' | $record->name === 'CASTIGO'){
                            return 'danger';
                        }
                        if ($record->name === 'LEGAL MORA'){
                            return 'danger2';
                        }
                        return 'warning';
                    }),
                
                TextColumn::make('rotativeline_count')
                ->counts('rotativeline')
                ->summarize(Sum::make()
                    ->label('') 
                    )
                
            ])
            ->pluralModelLabel('Things')

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            RotativelineRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStatuses::route('/'),
            'create' => Pages\CreateStatus::route('/create'),
            'view' => Pages\ViewStatus::route('/{record}'),
            'edit' => Pages\EditStatus::route('/{record}/edit'),
        ];
    }
}
