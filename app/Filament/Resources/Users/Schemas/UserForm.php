<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Role;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Full Name')
                    ->placeholder('Enter full name'),
                
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->label('Email Address')
                    ->placeholder('user@example.com'),

                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->required(fn($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                    ->minLength(8)
                    ->label('Password')
                    ->placeholder('Minimum 8 characters')
                    ->dehydrateStateUsing(fn($state) => $state ? \Illuminate\Support\Facades\Hash::make($state) : null)
                    ->dehydrated(fn($state) => filled($state)),

                CheckboxList::make('roles')
                    ->options(Role::pluck('name', 'id'))
                    ->columns(2)
                    ->label('Assign Roles')
                    ->afterStateUpdated(function ($state, $livewire) {
                        // This will be saved in afterSave hook
                    }),

                Toggle::make('active')
                    ->default(true)
                    ->label('Active Account'),
            ]);
    }
}
