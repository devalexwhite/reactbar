<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('sites', App\Http\Controllers\SiteController::class)
    ->only(['store']);

Route::get('/embed/{slug}', [App\Http\Controllers\ReactionBarController::class, 'show'])
    ->name('embed.show');

Route::post('/embed/{slug}/react', [App\Http\Controllers\ReactionBarController::class, 'react'])
    ->name('embed.react');