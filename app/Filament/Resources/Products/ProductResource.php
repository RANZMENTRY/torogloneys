<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Filament\Resources\Traits\NavigationGrouping;
use App\Models\Product;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProductResource extends Resource
{
    use NavigationGrouping;

    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = null;

    protected static ?string $navigationLabel = 'Products';
    
    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }
    
    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Product';

    protected static ?string $pluralModelLabel = 'Products';

    protected static ?string $recordTitleAttribute = 'name';

    public static function canAccess(): bool
    {
        $user = Auth::user();
        
        if (!$user instanceof User) {
            return false;
        }
        
        // Admin always has access
        if ($user->hasRole('admin')) {
            return true;
        }
        
        // Check for view_products permission
        return $user->hasPermission('view_products');
    }

    public static function canCreate(): bool
    {
        $user = Auth::user();
        
        if (!$user instanceof User) {
            return false;
        }
        
        // Admin always can create
        if ($user->hasRole('admin')) {
            return true;
        }
        
        // Check for create_products permission
        return $user->hasPermission('create_products');
    }

    public static function canEdit(Model $record): bool
    {
        $user = Auth::user();
        
        if (!$user instanceof User) {
            return false;
        }
        
        // Admin always can edit
        if ($user->hasRole('admin')) {
            return true;
        }
        
        // Check for edit_products permission
        return $user->hasPermission('edit_products');
    }

    public static function canDelete(Model $record): bool
    {
        $user = Auth::user();
        
        if (!$user instanceof User) {
            return false;
        }
        
        // Admin always can delete
        if ($user->hasRole('admin')) {
            return true;
        }
        
        // Check for delete_products permission
        return $user->hasPermission('delete_products');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
