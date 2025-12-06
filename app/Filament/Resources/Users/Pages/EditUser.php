<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $user = $this->record;
        $roleIds = $this->data['roles'] ?? [];

        // Clear existing roles
        DB::table('model_has_roles')
            ->where('model_id', $user->id)
            ->where('model_type', User::class)
            ->delete();

        // Insert new roles
        if (!empty($roleIds)) {
            foreach ($roleIds as $roleId) {
                DB::table('model_has_roles')->insert([
                    'model_type' => User::class,
                    'model_id' => $user->id,
                    'role_id' => $roleId,
                ]);
            }
        }
    }
}
