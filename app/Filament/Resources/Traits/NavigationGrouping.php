<?php

namespace App\Filament\Resources\Traits;

/**
 * Navigation Grouping Trait
 * 
 * Provides constants dan methods untuk mengorganisir navigation di Filament
 * dengan struktur yang rapi dan terstruktur berdasarkan fungsi bisnis.
 * 
 * Navigation Structure:
 * 1. Dashboard (standalone, tidak dalam group)
 * 2. Master Data (Categories, Products)
 * 3. User Management (Users, Roles, Permissions)
 */
trait NavigationGrouping
{
    /**
     * Navigation Group Constants
     */
    public const NAVIGATION_GROUP_MASTER_DATA = 'Master Data';
    public const NAVIGATION_GROUP_USER_MANAGEMENT = 'User Management';

    /**
     * Navigation Sort Order
     * 
     * Dashboard = -1 (paling atas, standalone)
     * Master Data Group = 0
     * - Categories = 0
     * - Products = 1
     * 
     * User Management Group = 100
     * - Users = 0
     * - Roles = 1
     * - Permissions = 2
     */
    public const SORT_DASHBOARD = -1;
    
    // Master Data Group (sort order 0, items inside: 0-99)
    public const SORT_MASTER_DATA_GROUP = 0;
    public const SORT_CATEGORIES = 0;
    public const SORT_PRODUCTS = 1;
    
    // User Management Group (sort order 100, items inside: 100-199)
    public const SORT_USER_MANAGEMENT_GROUP = 100;
    public const SORT_USERS = 100;
    public const SORT_ROLES = 101;
    public const SORT_PERMISSIONS = 102;

    /**
     * Get Navigation Group untuk Resource ini
     * 
     * Override property $navigationGroup di Resource class:
     * 
     * protected static ?string $navigationGroup = self::NAVIGATION_GROUP_MASTER_DATA;
     */
    // Method ini tidak perlu, langsung set property di Resource

    /**
     * Get Navigation Sort Order
     * 
     * Override property $navigationSort di Resource class:
     * 
     * protected static ?int $navigationSort = self::SORT_CATEGORIES;
     */
    // Method ini tidak perlu, langsung set property di Resource
}
