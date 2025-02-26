<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Rotativeline;
use Illuminate\Support\Facades\DB;

use Filament\Tables\Columns\Column;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Database\Eloquent\Builder;




class Rlstatustable extends BaseWidget
{
    protected static ?string $heading = 'RLs Status';
    protected static ?int $sort = 3;


    public function table(Table $table): Table
    {
        return $table

            //->query(Rotativeline::orderBy('status')->take('all'))

            ->query(
                Rotativeline::query()
                ->select(DB::raw("
                    *
                    ,case
                    when status in ('MORA') then 1
                    when status in ('LEGAL MORA') then 2
                    when status in ('CASTIGO') then 3
                    when status in ('VIGENTE') then 4
                    when status in ('CERRADA') then 5
                    else 0
                    end as priority
                    "))
                ->from(DB::raw('
                        (
                        select
                        status_id as id
                        ,max(status) as status 
                        ,count(*) as rls 
                        ,sum(capital_paid_amount) as capital_debt
                        from rotativelines
                        group by
                        status_id
                        ) as T'
                        ))
                ->take('all')
            )

            ->columns([
                // ...
                Tables\Columns\TextColumn::make('id')
                ->numeric()
                ->hidden(),

                Tables\Columns\TextColumn::make('priority')
                ->numeric(),
                

                Tables\Columns\TextColumn::make('status')
                ->grow(false)
                ->badge()
                ->color(fn (string $state): string=>match($state) {
                    'VIGENTE' => 'success',
                    'CERRADA' => 'gray',
                    'MORA' => 'danger',
                    'LEGAL MORA' => 'danger2',
                    'CASTIGO' => 'danger2',
                }),


                Tables\Columns\TextColumn::make('rls'),

                Tables\Columns\TextColumn::make('capital_debt')
                ->numeric(decimalPlaces: 0)
                ->sortable(),
            ])
            ->defaultSort('priority','asce')
            ;
    }
}
