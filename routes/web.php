<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\DeveloperManager;
use Livewire\Volt\Volt;
use App\Livewire\ArticleManager;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/developers', DeveloperManager::class)->name('developers');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/articles', ArticleManager::class)->name('articles');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
