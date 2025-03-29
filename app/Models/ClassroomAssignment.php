<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class ClassroomAssignment extends Model
{
    protected $fillable = [
        'classroom_course_id',
        'title',
        'content',
        'start',
        'end',
        'stop_date_sync',
    ];

    protected $casts = [
        'classroom_course_id' => 'integer',
        'title' => 'string',
        'content' => 'string',
        'start' => 'immutable_datetime',
        'end' => 'immutable_datetime',
        'stop_date_sync' => 'boolean',
    ];
}
