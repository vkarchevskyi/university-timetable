<?php

declare(strict_types=1);

namespace App\Services\Google;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Laravel\Socialite\Two\GoogleProvider;

final readonly class SaveGoogleUserDataService
{
    public function __construct(
        private GoogleProvider $googleProvider,
        #[CurrentUser]
        private User $user,
    ) {
    }

    public function handle(): void
    {
        $googleUser = $this->googleProvider->stateless()->user();

        $this->user->update([
            'google_id' => $googleUser->id,
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);
    }
}
