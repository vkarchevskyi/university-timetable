<?php

declare(strict_types=1);

use App\Http\Controllers\TelegramController;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', static fn (): View => view('welcome'));

Route::post('/telegram/webhook', [TelegramController::class, 'webhook'])
    ->withoutMiddleware([VerifyCsrfToken::class]);
