<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $user = $this->record;
        $roleIds = $this->data['roles'] ?? [];

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
