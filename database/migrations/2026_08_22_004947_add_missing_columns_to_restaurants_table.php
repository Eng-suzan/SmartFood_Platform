<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // All restaurant columns already exist
        // in create_restaurants_table migration.
    }

    public function down(): void
    {
        // Nothing to rollback.
    }
};