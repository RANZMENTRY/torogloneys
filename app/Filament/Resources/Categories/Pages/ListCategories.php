<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        $user = Auth::user();
        $canCreate = $user && CategoryResource::canCreate();
        
        return $canCreate ? [
            CreateAction::make(),
        ] : [];
    }
}
