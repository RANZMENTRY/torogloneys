<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Traits\NavigationGrouping;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    use NavigationGrouping;

    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $navigationLabel = 'Users';
    
    public static function getNavigationGroup(): ?string
    {
        return 'User Management';
    }
    
    protected static ?int $navigationSort = 100;

    protected static ?string $modelLabel = 'User';

    protected static ?string $pluralModelLabel = 'Users';

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
        
        // Check for view_users permission
        return $user->hasPermission('view_users');
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
        
        // Check for create_users permission
        return $user->hasPermission('create_users');
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
        
        // Check for edit_users permission
        return $user->hasPermission('edit_users');
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
        
        // Check for delete_users permission
        return $user->hasPermission('delete_users');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
