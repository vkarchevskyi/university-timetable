<?php

declare(strict_types=1);

namespace App\Jobs\Google;

use App\Services\Google\RefreshAuthTokenService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

final class RefreshAuthTokenJob implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(RefreshAuthTokenService $refreshAuthTokenService): void
    {
        $refreshAuthTokenService->handle();
    }
}
