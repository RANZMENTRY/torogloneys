<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        $user = Auth::user();
        $canCreate = $user && UserResource::canCreate();
        
        return $canCreate ? [
            Actions\CreateAction::make(),
        ] : [];
    }
}
