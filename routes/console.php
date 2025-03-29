<?php

declare(strict_types=1);

use App\Jobs;
use Illuminate\Support\Facades\Schedule;

Schedule::job(Jobs\Google\RefreshAuthTokenJob::class)->daily();
