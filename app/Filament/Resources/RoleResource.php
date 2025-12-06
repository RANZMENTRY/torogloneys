<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Roles\Pages\CreateRole;
use App\Filament\Resources\Roles\Pages\EditRole;
use App\Filament\Resources\Roles\Pages\ListRoles;
use App\Filament\Resources\Roles\Schemas\RoleForm;
use App\Filament\Resources\Roles\Tables\RolesTable;
use App\Models\Role;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedKey;

    protected static ?string $navigationLabel = 'Roles';

    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        $user = Auth::user();
        
        if (!$user instanceof User) {
            return false;
        }
        
        // Only admin can manage roles
        return $user->hasRole('admin');
    }

    public static function canCreate(): bool
    {
        $user = Auth::user();
        
        if (!$user instanceof User) {
            return false;
        }
        
        // Only admin can create roles
        return $user->hasRole('admin');
    }

    public static function canEdit(Model $record): bool
    {
        $user = Auth::user();
        
        if (!$user instanceof User) {
            return false;
        }
        
        // Only admin can edit roles
        return $user->hasRole('admin');
    }

    public static function canDelete(Model $record): bool
    {
        $user = Auth::user();
        
        if (!$user instanceof User) {
            return false;
        }
        
        // Only admin can delete roles
        return $user->hasRole('admin');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }

    public static function form(Schema $schema): Schema
    {
        return RoleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RolesTable::configure($table);
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
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }
}
