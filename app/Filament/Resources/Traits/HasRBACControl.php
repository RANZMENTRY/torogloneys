<?php

namespace App\Filament\Resources\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait HasRBACControl
{
    /**
     * Check if current user has permission
     */
    public static function canAccess(): bool
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            return false;
        }

        // Admin can access everything
        if ($user->hasRole('admin')) {
            return true;
        }

        // Get permission name from resource
        $permissionName = self::getRequiredPermission();
        return $user->hasPermission($permissionName);
    }

    /**
     * Check if user can create
     */
    public static function canCreate(): bool
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            return false;
        }

        if ($user->hasRole('admin')) {
            return true;
        }

        $resourceName = self::getResourceName();
        return $user->hasPermission("create_{$resourceName}");
    }

    /**
     * Check if user can edit
     */
    public static function canEdit(): bool
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            return false;
        }

        if ($user->hasRole('admin')) {
            return true;
        }

        $resourceName = self::getResourceName();
        return $user->hasPermission("edit_{$resourceName}");
    }

    /**
     * Check if user can delete
     */
    public static function canDelete(): bool
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            return false;
        }

        if ($user->hasRole('admin')) {
            return true;
        }

        $resourceName = self::getResourceName();
        return $user->hasPermission("delete_{$resourceName}");
    }

    /**
     * Get required permission for resource
     */
    protected static function getRequiredPermission(): string
    {
        return 'view_' . self::getResourceName();
    }

    /**
     * Get resource name (lowercase plural)
     */
    protected static function getResourceName(): string
    {
        $class = class_basename(static::class);
        return strtolower(str_replace('Resource', '', $class));
    }

    /**
     * Check if user has role
     */
    protected static function userHasRole(string $role): bool
    {
        $user = Auth::user();
        return ($user instanceof User) ? $user->hasRole($role) : false;
    }

    /**
     * Check if user has permission
     */
    protected static function userHasPermission(string $permission): bool
    {
        $user = Auth::user();
        return ($user instanceof User) ? $user->hasPermission($permission) : false;
    }
}
