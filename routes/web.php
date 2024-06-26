<?php

use App\Livewire\Contracts;
use App\Livewire\Players;
use App\Livewire\SoccerMatches;
use App\Livewire\Teams;
use Illuminate\Support\Facades\Route;

use App\Models\Event;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Route for Teams Livewire component
Route::get('/teams', Teams::class)
    ->middleware(['auth'])
    ->name('teams');

// Route for Players Livewire component
Route::get('/players', Players::class)
    ->middleware(['auth'])
    ->name('players');

// Route for Contracts Livewire component
Route::get('/contracts', Contracts::class)
    ->middleware(['auth'])
    ->name('contracts');

// Route for Gameplay view
Route::get('/gameplay', function () {
    return view('gameplay');
})
    ->middleware(['auth'])
    ->name('gameplay');

// Route for events view
Route::get('/events', function () {
    return Event::all();
});

 //Route for soccer matches view
Route::get('/soccer-matches', SoccerMatches::class)
    ->middleware(['auth'])
    ->name('soccer-matches');

// Include authentication routes
require __DIR__.'/auth.php';


