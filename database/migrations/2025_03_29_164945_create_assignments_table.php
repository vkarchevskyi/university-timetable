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
        Schema::create('classroom_assignments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('classroom_course_id');
            $table->foreign('classroom_course_id')
                ->references('id')
                ->on('courses')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->string('title');
            $table->text('content');

            $table->timestamp('start');
            $table->timestamp('end')->nullable();
            $table->boolean('stop_date_sync');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_assignments');
    }
};
