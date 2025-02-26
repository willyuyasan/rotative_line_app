<?php

namespace App\Filament\Resources\RotativeLineResource\Pages;

use App\Filament\Resources\RotativeLineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRotativeLine extends EditRecord
{
    protected static string $resource = RotativeLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
