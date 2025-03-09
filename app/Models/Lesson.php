<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\LessonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Lesson extends Model
{
    /** @use HasFactory<LessonFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'day_of_week',
        'order',
        'is_numerator',
    ];

    protected $casts = [
        'is_numerator' => 'boolean',
    ];
}
