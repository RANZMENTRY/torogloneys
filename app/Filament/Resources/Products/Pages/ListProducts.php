<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        $user = Auth::user();
        $canCreate = $user && ProductResource::canCreate();
        
        return $canCreate ? [
            CreateAction::make(),
        ] : [];
    }
}
