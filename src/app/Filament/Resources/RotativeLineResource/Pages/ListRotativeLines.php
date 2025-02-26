<?php

namespace App\Filament\Resources\RotativeLineResource\Pages;

use App\Filament\Resources\RotativeLineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRotativeLines extends ListRecords
{
    protected static string $resource = RotativeLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
