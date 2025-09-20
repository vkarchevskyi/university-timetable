<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->unsignedTinyInteger('week_type')->nullable()->after('is_numerator');
        });

        DB::table('lessons')->whereNull('is_numerator')->update(['week_type' => 3]);
        DB::table('lessons')->where('is_numerator', true)->update(['week_type' => 1]);
        DB::table('lessons')->where('is_numerator', false)->update(['week_type' => 2]);

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('is_numerator');
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->unsignedTinyInteger('week_type')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->boolean('is_numerator')->nullable()->after('week_type');
        });

        DB::table('lessons')->where('week_type', 3)->update(['is_numerator' => null]);
        DB::table('lessons')->where('week_type', 1)->update(['is_numerator' => true]);
        DB::table('lessons')->where('week_type', 2)->update(['is_numerator' => false]);

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('week_type');
        });
    }
};
