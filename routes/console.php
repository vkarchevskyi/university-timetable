<?php

declare(strict_types=1);

use App\Jobs;
use Illuminate\Support\Facades\Schedule;

Schedule::job(Jobs\Google\RefreshAuthTokenJob::class)->hourly();
Schedule::job(Jobs\Assignments\Classroom\SyncClassroomCoursesJob::class)->hourlyAt(5);
