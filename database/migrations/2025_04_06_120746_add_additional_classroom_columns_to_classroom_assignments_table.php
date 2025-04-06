<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('classroom_assignments', function (Blueprint $table) {
            $table->dropColumn(['content', 'start', 'end']);
            $table->dropForeign(['classroom_course_id']);
            $table->foreign('classroom_course_id')
                ->references('id')
                ->on('classroom_courses')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('classroom_id')->unique();
            $table->string('title', 3000)->change();
            $table->text('description')->nullable();
            $table->jsonb('materials')->default('[]');
            $table->enum('state', [
                'COURSE_WORK_STATE_UNSPECIFIED',
                'PUBLISHED',
                'DRAFT',
                'DELETED',
            ]);
            $table->string('alternate_link');
            $table->unsignedSmallInteger('max_points')->nullable();
            $table->timestamp('due_datetime')->nullable()->index();
            $table->enum('work_type', [
                'COURSE_WORK_TYPE_UNSPECIFIED',
                'ASSIGNMENT',
                'SHORT_ANSWER_QUESTION',
                'MULTIPLE_CHOICE_QUESTION',
            ]);
            $table->enum('assignee_mode', [
                'ASSIGNEE_MODE_UNSPECIFIED',
                'ALL_STUDENTS',
                'INDIVIDUAL_STUDENTS',
            ])->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classroom_assignments', function (Blueprint $table) {
            $table->text('content');
            $table->timestamp('start');
            $table->timestamp('end')->nullable();
            $table->string('title')->change();

            $table->dropForeign(['classroom_course_id']);
            $table->foreign('classroom_course_id')
                ->references('id')
                ->on('courses')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->dropUnique(['classroom_id']);
            $table->dropIndex(['assignee_mode']);
            $table->dropIndex(['due_datetime']);

            $table->dropColumn([
                'classroom_id',
                'description',
                'materials',
                'state',
                'alternate_link',
                'max_points',
                'due_datetime',
                'work_type',
                'assignee_mode',
            ]);
        });
    }
};
