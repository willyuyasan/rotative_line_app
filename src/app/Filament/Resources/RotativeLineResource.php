<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Rotativeline;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;

use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;

use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Facades\FilamentColor;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RotativeLineResource\Pages;
use App\Filament\Resources\RotativeLineResource\RelationManagers;

 
FilamentColor::register([
    //'danger2' => Color::rgb('rgb(153, 27, 27)'),
    //'danger2' => Color::hex('#aa75ba'),
    'danger2' => Color::hex('#b0347f'), //purple
]);


class RotativeLineResource extends Resource
{
    protected static ?string $model = Rotativeline::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                TextInput::make('number_line')
                ->required()
                ->maxLength(7),

                TextInput::make('issuer_tax_number')
                ->required()
                ->maxLength(20),

                Forms\Components\TextInput::make('issuer_name')
                ->required()
                ->maxLength(100),

                Forms\Components\DatePicker::make('disbursement_date')
                ->required()
                ->maxDate(now()->addDays(5)),

                Forms\Components\DatePicker::make('payment_date')
                ->required()
                ->maxDate(now()->addDays(180)),

                Forms\Components\TextInput::make('discount_rate')
                ->required()
                ->numeric()
                ->default(0)
                ->minValue(0)
                ->maxValue(1),

                Forms\Components\TextInput::make('financed_amount')
                ->required()
                ->numeric()
                ->default(null)
                ->minValue(10000000)
                ->maxValue(2000000000),

                Forms\Components\TextInput::make('new_expected_payment')
                ->numeric()
                ->default(0)
                ->minValue(0),

                Forms\Components\Select::make('status_name')
                ->relationship('status', 'name')
                ->searchable()
                ->preload()
                ->required(),
                
                
                Forms\Components\Select::make('product')
                ->relationship('product', 'product_name')
                ->searchable()
                ->preload()
                ->required(),

            ])
            ->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('number_line')
                    ->searchable()
                    ->grow(false),

                // this viewcolumn stacks 2 columns for supplier (issuer_tax_number, issuer_name)
                //ViewColumn::make('supplier')
                //    ->view('custom-stack'), 

                TextColumn::make('issuer_name')
                    ->description(fn ($record): string => $record->issuer_tax_number)
                    ->limit(20)
                    ->searchable(['issuer_name','issuer_tax_number']),
                
                TextColumn::make('issuer_tax_number')
                    ->searchable()
                    ->hidden(),
                
                Tables\Columns\TextColumn::make('disbursement_date')
                ->grow(false),
                Tables\Columns\TextColumn::make('payment_date')
                ->grow(false),
                Tables\Columns\TextColumn::make('financed_amount'),
                Tables\Columns\TextColumn::make('discount_rate')
                ->grow(false),
                #Tables\Columns\TextColumn::make('status')
                #->grow(false)
                #->badge()
                #->color(fn (string $state): string=>match($state) {
                #    'OK' => 'success',
                #    'PROXIMA A VENCER' => 'info',
                #    'CUOTA VENCIDA' => 'warning',
                #    'MORA' => 'danger',
                #    'CERRADA' => 'gray',
                #    'LEGAL' => 'danger2',
                #    'CASTIGO' => 'danger2',
                #}),
                Tables\Columns\TextColumn::make('new_expected_payment'),
                Tables\Columns\TextColumn::make('product.product_name')
                ->grow(false),

            ])
            ->filters([
                //
                SelectFilter::make('status')
                ->options(fn (): array => Rotativeline::query()->pluck('status','status')->all())
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
            RelationManagers\QuoteRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRotativeLines::route('/'),
            'create' => Pages\CreateRotativeLine::route('/create'),
            'edit' => Pages\EditRotativeLine::route('/{record}/edit'),
            'view' => Pages\ViewRotativeLine::route('/{record}'),
        ];
    }
}
