<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('sites', App\Http\Controllers\SiteController::class)
    ->only(['store']);

Route::get('/embed/{slug}', [App\Http\Controllers\ReactionBarController::class, 'show'])
    ->name('embed.show');

Route::post('/embed/{slug}/react', [App\Http\Controllers\ReactionBarController::class, 'react'])
    ->name('embed.react');

Route::get('/sites/{site}/{admin_slug}', [App\Http\Controllers\SiteController::class, 'show'])
    ->name('sites.show');

Route::post('/sites/{site}/reaction-types', [SiteController::class, 'updateReactionTypes'])->name('sites.updateReactionTypes');

// Only register /test route if not in production
if (app()->environment() !== 'production') {
    Route::get('/test', function () {
        return view('embed.test');
    })->name('embed.test');
}