<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {

            $table->time('opening_time')
                ->default('08:00:00')
                ->after('is_open');

            $table->time('closing_time')
                ->default('03:00:00')
                ->after('opening_time');

        });
    }

    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {

            $table->dropColumn([
                'opening_time',
                'closing_time'
            ]);

        });
    }
};