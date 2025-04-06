<?php

declare(strict_types=1);

namespace App\Actions\Google;

use App\Models\User;
use Laravel\Socialite\Two\GoogleProvider;
use RuntimeException;

final readonly class RefreshAuthTokenAction
{
    public function __construct(private GoogleProvider $googleProvider)
    {
    }

    public function handle(): void
    {
        $user = User::googleServiceAccount()->firstOrFail();
        if (is_null($user->google_refresh_token)) {
            throw new RuntimeException("Service User doesn't have google refresh token");
        }

        $tokenData = $this->googleProvider->refreshToken($user->google_refresh_token);
        $user->update([
            'google_token' => $tokenData->token,
            'google_refresh_token' => $tokenData->refreshToken,
        ]);
    }
}
