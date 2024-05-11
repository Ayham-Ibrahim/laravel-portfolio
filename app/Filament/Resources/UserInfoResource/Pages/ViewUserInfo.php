<?php

namespace App\Filament\Resources\UserInfoResource\Pages;

use App\Filament\Resources\UserInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUserInfo extends ViewRecord
{
    protected static string $resource = UserInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
