<?php

declare(strict_types=1);

namespace App\Services\Google;

use App\Models\User;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;

final readonly class RefreshAuthTokenService
{
    public function handle(): void
    {
        /** @var GoogleProvider $googleProvider */
        $googleProvider = Socialite::driver('google');
        $classroomUserEmail = Config::string('services.google.classroom.email');

        /** @var User $user */
        $user = User::whereEmail($classroomUserEmail)->firstOrFail();

        $tokenData = $googleProvider->refreshToken($user->google_refresh_token);

        $user->update([
            'google_token' => $tokenData->token,
            'google_refresh_token' => $tokenData->refreshToken,
        ]);
    }
}
