<?php

namespace App\Filament\Resources\RoleResource\Schemas;

use App\Models\Permission;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Schema;

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
                    ->placeholder('e.g., Admin, Editor, Viewer'),
                Textarea::make('description')
                    ->maxLength(500)
                    ->placeholder('Role description')
                    ->helperText('Describe the purpose of this role'),
                CheckboxList::make('permissions')
                    ->relationship('permissions', 'name')
                    ->options(fn() => Permission::query()
                        ->orderBy('module')
                        ->orderBy('name')
                        ->pluck('description', 'id')
                    )
                    ->columns(2),
            ]);
    }
}
