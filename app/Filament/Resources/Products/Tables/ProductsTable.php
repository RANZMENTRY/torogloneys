<?php

namespace App\Filament\Resources\Products\Tables;

use App\Models\Category;
use App\Filament\Resources\Products\ProductResource;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        $user = Auth::user();
        $canEdit = false;
        $canDelete = false;
        
        if ($user instanceof User) {
            $canEdit = ProductResource::canEdit($user) || $user->hasRole('admin');
            $canDelete = ProductResource::canDelete($user) || $user->hasRole('admin');
        }
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->square()
                    ->width(60)
                    ->height(60),
                    
                TextColumn::make('name')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable()
                    ->grow(),
                    
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),
                    
                TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->formatStateUsing(fn (int $state): string => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->alignEnd(),
                    
                BadgeColumn::make('stock')
                    ->label('Stock')
                    ->sortable()
                    ->colors([
                        'danger' => static fn ($state): bool => $state < 1,
                        'warning' => static fn ($state): bool => $state < 10,
                        'success' => static fn ($state): bool => $state >= 10,
                    ])
                    ->icons([
                        'heroicon-o-exclamation-circle' => static fn ($state): bool => $state < 1,
                        'heroicon-o-exclamation-triangle' => static fn ($state): bool => $state < 10,
                        'heroicon-o-check-circle' => static fn ($state): bool => $state >= 10,
                    ])
                    ->alignCenter(),
                    
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
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->options(Category::pluck('name', 'id'))
                    ->native(false),
                    
                Filter::make('active')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('active', true))
                    ->label('Active products only'),
                    
                Filter::make('out_of_stock')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('stock', '<', 1))
                    ->label('Out of stock only'),
                    
                Filter::make('low_stock')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->whereBetween('stock', [1, 9]))
                    ->label('Low stock (< 10)'),
            ])
            ->searchPlaceholder('Search by name or SKU...')
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
