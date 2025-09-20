<?php

declare(strict_types=1);

namespace App\Jobs\Assignments\Classroom;

use App\Exceptions\Assignments\GoogleClassroom\ApiAuthenticationException;
use App\Jobs\Google\RefreshAuthTokenJob;
use App\Models\ClassroomCourse;
use App\Services\Assignments\GoogleClassroom\SyncClassroomAssignmentService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Throwable;

final class SyncClassroomAssignmentsJob implements ShouldQueue
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
    public int $timeout = 120;

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
    public function handle(SyncClassroomAssignmentService $syncClassroomAssignmentAction): void
    {
        DB::beginTransaction();

        try {
            ClassroomCourse::query()
                ->active()
                ->orderBy('id')
                ->chunk(10, static function (Collection $courses) use ($syncClassroomAssignmentAction): void {
                    $courses->each(
                        static function (ClassroomCourse $course) use ($syncClassroomAssignmentAction): void {
                            $syncClassroomAssignmentAction->handle($course);
                        }
                    );
                });

            DB::commit();
        } catch (ApiAuthenticationException) {
            DB::rollBack();
            RefreshAuthTokenJob::dispatchSync();
            $this->release(3);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
