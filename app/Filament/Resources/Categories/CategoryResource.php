<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Categories\Tables\CategoriesTable;
use App\Filament\Resources\Traits\NavigationGrouping;
use App\Models\Category;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Categories';
    
    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }
    
    protected static ?int $navigationSort = 0;

    protected static ?string $modelLabel = 'Category';

    protected static ?string $pluralModelLabel = 'Categories';

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
        
        // Check for view_categories permission
        return $user->hasPermission('view_categories');
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
        
        // Check for create_categories permission
        return $user->hasPermission('create_categories');
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
        
        // Check for edit_categories permission
        return $user->hasPermission('edit_categories');
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
        
        // Check for delete_categories permission
        return $user->hasPermission('delete_categories');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
