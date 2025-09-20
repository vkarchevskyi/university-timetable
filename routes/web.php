<?php

declare(strict_types=1);

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ExceptionController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\TeacherController;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', static fn (): View => view('pages.main'))
    ->name('homepage');

Route::get('/login', static fn (): RedirectResponse => new RedirectResponse('/admin/login'))
    ->name('login');

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

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Exceptions Management
    Route::resource('exceptions', ExceptionController::class);
    Route::post('exceptions/bulk-destroy', [ExceptionController::class, 'bulkDestroy'])->name('exceptions.bulk-destroy');

    // Lessons Management
    Route::resource('lessons', LessonController::class);
    Route::post('lessons/bulk-destroy', [LessonController::class, 'bulkDestroy'])->name('lessons.bulk-destroy');

    // Teachers Management
    Route::resource('teachers', TeacherController::class);
    Route::post('teachers/bulk-destroy', [TeacherController::class, 'bulkDestroy'])->name('teachers.bulk-destroy');
});
