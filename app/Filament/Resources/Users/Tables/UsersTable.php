<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        $user = Auth::user();
        $canEdit = false;
        $canDelete = false;
        
        if ($user instanceof User) {
            $canEdit = UserResource::canEdit($user) || $user->hasRole('admin');
            $canDelete = UserResource::canDelete($user) || $user->hasRole('admin');
        }
        
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                    
                IconColumn::make('email_verified_at')
                    ->label('Email Verified')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->sortable(),
                    
                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
                    ->color('info')
                    ->separator(',')
                    ->sortable(),
                    
                IconColumn::make('active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                    
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->label('Filter by Role'),
                    
                Filter::make('email_verified')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at'))
                    ->label('Email Verified'),
                    
                Filter::make('active')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('active', true))
                    ->label('Active Users Only'),
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

