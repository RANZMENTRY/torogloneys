<?php

namespace App\Filament\Resources\Categories\Tables;

use App\Filament\Resources\Categories\CategoryResource;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        $user = Auth::user();
        $canEdit = false;
        $canDelete = false;
        
        if ($user instanceof User) {
            $canEdit = CategoryResource::canEdit($user) || $user->hasRole('admin');
            $canDelete = CategoryResource::canDelete($user) || $user->hasRole('admin');
        }
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Category Name')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('slug')
                    ->label('URL Slug')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyableState(fn (string $state): string => "{$state}"),
                    
                IconColumn::make('active')
                    ->label('Status')
                    ->boolean()
                    ->sortable()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                    
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                Filter::make('active')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('active', true))
                    ->label('Active categories only'),
                    
                Filter::make('inactive')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('active', false))
                    ->label('Inactive categories only'),
            ])
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
