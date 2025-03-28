<?php

declare(strict_types=1);

namespace App\Services\Google;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Laravel\Socialite\Two\GoogleProvider;

final readonly class RefreshAuthTokenService
{
    public function __construct(
        private GoogleProvider $googleProvider,
        #[CurrentUser]
        private User $user,
    ) {
    }

    public function handle(): void
    {
        $tokenData = $this->googleProvider->refreshToken($this->user->google_refresh_token);

        $this->user->update([
            'google_token' => $tokenData->token,
            'google_refresh_token' => $tokenData->refreshToken,
        ]);
    }
}
