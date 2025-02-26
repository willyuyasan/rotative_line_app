<?php

namespace App\Filament\Resources\StatusResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Rotativeline;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use AnourValar\EloquentSerialize\Tests\Models\Post;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class RotativelineRelationManager extends RelationManager
{
    protected static string $relationship = 'rotativeline';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number_line')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('number_line')
            ->columns([

                TextColumn::make('number_line')
                ->searchable()
                ->grow(false),

                TextColumn::make('issuer_name')
                    ->description(fn ($record): string => $record->issuer_tax_number)
                    ->limit(20)
                    ->searchable(['issuer_name','issuer_tax_number']),
                
                TextColumn::make('issuer_tax_number')
                    ->searchable()
                    ->hidden(),
                
                TextColumn::make('disbursement_date')
                ->grow(false),
                
                TextColumn::make('payment_date')
                ->grow(false),
                
                TextColumn::make('financed_amount'),
                
                TextColumn::make('discount_rate')
                ->grow(false),

                TextColumn::make('new_expected_payment'),
                
                TextColumn::make('product.product_name')
                ->grow(false),


                TextColumn::make('Ver_linea')
                ->label('')
                ->default('Ver linea...')
                ->grow(false)
                ->url(fn (Rotativeline $record): string => route('filament.admin.resources.rotative-lines.view', ['record' => $record->id])),

            ])
            ->defaultSort('payment_date','asce')

            ->filters([
                //
                SelectFilter::make('product')
                ->relationship('product', 'product_name')
                ->options(fn (): array => Product::query()->pluck('product_name','product_name')->all()),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
