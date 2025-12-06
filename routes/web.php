<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Force logout and clear all sessions
Route::get('/admin/force-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    
    return redirect('/admin/login')->with('status', 'Logged out successfully');
});
