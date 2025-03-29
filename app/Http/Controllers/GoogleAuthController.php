<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Google\SaveGoogleUserDataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

final class GoogleAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')
            ->with([
                'access_type' => 'offline',
                'prompt' => 'consent',
            ])
            ->scopes(Config::array('services.google.scopes'))
            ->redirect();
    }

    public function callback(SaveGoogleUserDataService $saveGoogleUserDataService): JsonResponse
    {
        $saveGoogleUserDataService->handle();

        return new JsonResponse(['success' => 'Google Classroom connected successfully!']);
    }
}
