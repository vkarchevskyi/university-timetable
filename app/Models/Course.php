<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Course extends Model
{
    protected $fillable = [
        'title',
    ];

    protected $casts = [
        'title' => 'string',
    ];
}
