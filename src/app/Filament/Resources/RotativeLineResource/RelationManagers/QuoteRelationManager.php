<?php

namespace App\Filament\Resources\RotativeLineResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteRelationManager extends RelationManager
{
    protected static string $relationship = 'payment_plan_quotes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('quote')
                    ->required()
                    ->integer()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('credit_term_init_date')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\DatePicker::make('credit_term_end_date')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\TextInput::make('capital_fee_amount')
                    ->integer()
                    ->prefix('$')
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->datalist([
                        'PENDING',
                        'PIAD',
                        'UNPAID',
                    ])
                    ->default('PENDING'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('capital_fee_amount')
            ->columns([
                Tables\Columns\TextColumn::make('quote'),
                Tables\Columns\TextColumn::make('capital_fee_amount')
                    ->prefix('$'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                //
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
