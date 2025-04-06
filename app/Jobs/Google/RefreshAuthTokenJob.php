<?php

declare(strict_types=1);

namespace App\Jobs\Google;

use App\Actions\Google\RefreshAuthTokenAction;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Config;

final class RefreshAuthTokenJob implements ShouldBeUnique, ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(RefreshAuthTokenAction $refreshAuthTokenService): void
    {
        $refreshAuthTokenService->handle();
    }

    /**
     * Get the unique ID for the job.
     */
    public function uniqueId(): string
    {
        return Config::string('services.google.classroom.email');
    }
}
