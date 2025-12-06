<?php

namespace App\Filament\Resources\Roles\Schemas;

use App\Models\Permission;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Collection;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->label('Role Name')
                    ->placeholder('e.g., Admin, Staff, Editor'),

                CheckboxList::make('permissions')
                    ->relationship('permissions', 'name')
                    ->options(self::getGroupedPermissions())
                    ->columns(1)
                    ->label('Permissions')
                    ->descriptions(self::getPermissionDescriptions()),
            ]);
    }

    protected static function getGroupedPermissions(): array
    {
        $permissions = Permission::query()
            ->orderBy('module')
            ->orderBy('name')
            ->get();

        $grouped = [];
        foreach ($permissions as $permission) {
            $module = $permission->module ?? 'Other';
            $grouped[$module][$permission->id] = $permission->name;
        }

        // Flatten for CheckboxList but keep module info
        $result = [];
        foreach ($grouped as $module => $items) {
            foreach ($items as $id => $name) {
                $result[$id] = "{$module} - {$name}";
            }
        }

        return $result;
    }

    protected static function getPermissionDescriptions(): array
    {
        $permissions = Permission::all();
        $descriptions = [];

        foreach ($permissions as $permission) {
            $descriptions[$permission->id] = $permission->description;
        }

        return $descriptions;
    }
}
