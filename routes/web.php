<?php

declare(strict_types=1);

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\TelegramController;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', static fn (): View => view('welcome'))
    ->name('homepage');

Route::post('/telegram/webhook', [TelegramController::class, 'webhook'])
    ->name('telegram.webhook')
    ->withoutMiddleware([VerifyCsrfToken::class]);

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])
    ->middleware(['auth'])
    ->name('auth.google');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])
    ->name('auth.google.callback')
    ->middleware(['auth'])
    ->withoutMiddleware(VerifyCsrfToken::class);
