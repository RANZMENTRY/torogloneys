<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionResource\Pages\ListPermissions;
use App\Models\Permission;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static string|BackedEnum|null $navigationIcon = null;

    protected static ?string $navigationLabel = 'Permissions';
    
    public static function getNavigationGroup(): ?string
    {
        return 'User Management';
    }
    
    protected static ?int $navigationSort = 102;

    public static function canAccess(): bool
    {
        $user = Auth::user();
        
        if (!$user instanceof User) {
            return false;
        }
        
        // Only admin can view permissions
        return $user->hasRole('admin');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                // Permissions are read-only
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('module')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('guard_name')
                    ->label('Guard')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('roles_count')
                    ->label('Roles')
                    ->counts('roles')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('module')
                    ->options([
                        'Dashboard' => 'Dashboard',
                        'Categories' => 'Categories',
                        'Products' => 'Products',
                        'Orders' => 'Orders',
                        'Users' => 'Users',
                        'Settings' => 'Settings',
                    ]),
                Tables\Filters\SelectFilter::make('guard_name')
                    ->options([
                        'web' => 'Web',
                        'api' => 'API',
                    ]),
            ])
            ->actions([
                // Permissions are read-only
            ])
            ->bulkActions([
                // No bulk actions for permissions
            ]);
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
            'index' => ListPermissions::route('/'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }
}
