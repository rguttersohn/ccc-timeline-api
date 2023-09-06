<?php

namespace App\Filament\Resources\EventGroupResource\Pages;

use App\Filament\Resources\EventGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventGroup extends EditRecord
{
    protected static string $resource = EventGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
