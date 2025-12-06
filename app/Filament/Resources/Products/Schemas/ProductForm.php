<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Category;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Product Name')
                    ->placeholder('Enter product name'),
                    
                Select::make('category_id')
                    ->label('Category')
                    ->required()
                    ->options(Category::where('active', true)->pluck('name', 'id'))
                    ->placeholder('Select a category')
                    ->native(false),
                    
                TextInput::make('price')
                    ->label('Price (Rp)')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->step('0.01')
                    ->prefix('Rp')
                    ->placeholder('0'),
                    
                TextInput::make('stock')
                    ->label('Stock Quantity')
                    ->required()
                    ->integer()
                    ->minValue(0)
                    ->default(0)
                    ->placeholder('0'),
                    
                TextInput::make('sku')
                    ->label('SKU (Product Code)')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->helperText('Auto-generated if left empty')
                    ->placeholder('Auto-generate'),
                    
                FileUpload::make('image')
                    ->label('Product Image')
                    ->image()
                    ->maxSize(2048)
                    ->directory('products')
                    ->visibility('public'),
                    
                Textarea::make('description')
                    ->label('Description')
                    ->maxLength(1000)
                    ->rows(4)
                    ->placeholder('Enter product description'),
                    
                Toggle::make('active')
                    ->default(true)
                    ->label('Active')
                    ->helperText('Enable or disable this product'),
            ]);
    }
}
