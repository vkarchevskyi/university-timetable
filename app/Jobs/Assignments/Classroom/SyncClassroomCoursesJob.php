<?php

declare(strict_types=1);

namespace App\Jobs\Assignments\Classroom;

use App\Actions\Assignments\GoogleClassroom\SyncClassroomCoursesAction;
use App\Exceptions\Assignments\GoogleClassroom\AuthenticationException;
use App\Jobs\Google\RefreshAuthTokenJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

final class SyncClassroomCoursesJob implements ShouldQueue
{
    use Queueable;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public int $timeout = 30;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public int $backoff = 5;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(SyncClassroomCoursesAction $syncClassroomCoursesAction): void
    {
        try {
            $syncClassroomCoursesAction->handle();
        } catch (AuthenticationException) {
            RefreshAuthTokenJob::dispatchSync();
            $this->release(3);
        }
    }
}
