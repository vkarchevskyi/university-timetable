<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Google\SaveGoogleUserDataService;
use Illuminate\Container\Attributes\Config;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Two\GoogleProvider;

final class GoogleAuthController extends Controller
{
    /**
     * @param string[] $scopes
     */
    public function redirect(
        GoogleProvider $googleProvider,
        #[Config('services.google.scopes')] array $scopes,
    ): RedirectResponse {
        return $googleProvider
            ->with([
                'access_type' => 'offline',
                'prompt' => 'consent',
            ])
            ->scopes($scopes)
            ->redirect();
    }

    public function callback(SaveGoogleUserDataService $saveGoogleUserDataService): JsonResponse
    {
        $saveGoogleUserDataService->handle();

        return new JsonResponse(['success' => 'Google Classroom connected successfully!']);
    }
}
