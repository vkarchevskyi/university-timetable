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
        Schema::table('classroom_courses', function (Blueprint $table) {
            $table->string('owner_id');
            $table->string('classroom_id')->index();
            $table->enum('course_state', [
                'COURSE_STATE_UNSPECIFIED',
                'ACTIVE',
                'ARCHIVED',
                'PROVISIONED',
                'DECLINED',
                'SUSPENDED',
            ])->index();
            $table->string('alternate_link');
            $table->string('calendar_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classroom_courses', function (Blueprint $table) {
            $table->dropIndex(['course_state']);
            $table->dropIndex(['classroom_id']);

            $table->dropColumn([
                'owner_id',
                'classroom_id',
                'course_state',
                'alternate_link',
                'calendar_id',
            ]);
        });
    }
};
