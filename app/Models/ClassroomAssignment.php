<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $classroom_course_id
 * @property string $title
 * @property string $content
 * @property \Carbon\CarbonImmutable $start
 * @property \Carbon\CarbonImmutable|null $end
 * @property bool $stop_date_sync
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomAssignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomAssignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomAssignment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomAssignment whereClassroomCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomAssignment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomAssignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomAssignment whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomAssignment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomAssignment whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomAssignment whereStopDateSync($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomAssignment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomAssignment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
