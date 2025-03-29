<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int|null $course_id
 * @property int|null $teacher_id
 * @property string $name
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourse query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourse whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourse whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassroomCourse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class ClassroomCourse extends Model
{
    protected $fillable = [
        'course_id',
        'teacher_id',
        'name',
    ];

    protected $casts = [
        'course_id' => 'integer',
        'teacher_id' => 'integer',
        'name' => 'string',
    ];
}
