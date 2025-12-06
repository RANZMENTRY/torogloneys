<?php

namespace App\Filament\Resources\Roles\Tables;

use App\Filament\Resources\RoleResource;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class RolesTable
{
    public static function configure(Table $table): Table
    {
        $user = Auth::user();
        $canEdit = false;
        $canDelete = false;
        
        if ($user instanceof User) {
            $canEdit = RoleResource::canEdit($user) || $user->hasRole('admin');
            $canDelete = RoleResource::canDelete($user) || $user->hasRole('admin');
        }
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Role Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('permissions_count')
                    ->label('Permissions')
                    ->counts('permissions')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([])
            ->recordActions($canEdit ? [
                EditAction::make(),
            ] : [])
            ->toolbarActions($canDelete ? [
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ] : []);
    }
}
