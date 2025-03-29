<?php

declare(strict_types=1);

namespace App\Services\Google;

use App\Models\User;
use Illuminate\Container\Attributes\Config;
use Laravel\Socialite\Two\GoogleProvider;
use RuntimeException;

final readonly class RefreshAuthTokenService
{
    public function __construct(
        private GoogleProvider $googleProvider,
        #[Config('services.google.classroom.email')] private string $serviceEmail
    ) {
    }

    public function handle(): void
    {
        $user = User::whereEmail($this->serviceEmail)->firstOrFail();
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
