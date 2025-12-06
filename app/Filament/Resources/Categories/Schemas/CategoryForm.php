<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->label('Category Name')
                    ->placeholder('Enter category name'),
                    
                TextInput::make('slug')
                    ->readOnly()
                    ->disabled()
                    ->maxLength(255)
                    ->label('URL Slug')
                    ->helperText('Auto-generated from the category name'),
                    
                Toggle::make('active')
                    ->default(true)
                    ->label('Active')
                    ->helperText('Enable or disable this category'),
            ]);
    }
}
