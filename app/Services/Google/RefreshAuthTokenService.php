<?php

declare(strict_types=1);

namespace App\Services\Google;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Laravel\Socialite\Two\GoogleProvider;
use Laravel\Socialite\Two\Token;

final readonly class RefreshAuthTokenService
{
    public function __construct(
        private GoogleProvider $googleProvider,
        #[CurrentUser]
        private User $user,
    ) {
    }

    public function handle(Token $token): void
    {
        $tokenData = $this->googleProvider->refreshToken($this->user->google_refresh_token);

        $this->user->update([
            'google_token' => $tokenData->token,
            'google_refresh_token' => $token->refreshToken,
        ]);
    }
}
