<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserObserver
{
    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // This is handled by the mutator, but we keep it here for safety
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Handle role assignment if provided in request
        if (request()->has('data.roles')) {
            $roleIds = request()->input('data.roles', []);
            
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
}
