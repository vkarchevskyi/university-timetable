<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class ClassroomCourse extends Model
{
    protected $fillable = [
        'course_id',
        'teacher_id',
        'title',
    ];

    protected $casts = [
        'course_id' => 'integer',
        'teacher_id' => 'integer',
        'title' => 'string',
    ];
}
