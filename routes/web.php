<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Route for Teams Livewire component
Route::get('/teams', \App\Livewire\Teams::class)
    ->middleware(['auth'])
    ->name('teams');

// Route for Players Livewire component
Route::get('/players', \App\Livewire\Players::class)
    ->middleware(['auth'])
    ->name('players');

// Route for Contracts Livewire component
Route::get('/contracts', \App\Livewire\Contracts::class)
    ->middleware(['auth'])
    ->name('contracts');

// Route for Main Menu view
Route::get('/main-menu', function () {
    return view('main-menu');
})->middleware(['auth'])->name('main-menu');

// Route for Gameplay view
Route::get('/gameplay', function () {
    return view('gameplay');
})
    ->middleware(['auth'])
    ->name('gameplay');

// Route for Style Guide view
Route::view('style-guide', 'style-guide')
    ->middleware(['auth'])
    ->name('style-guide');

require __DIR__.'/auth.php';
