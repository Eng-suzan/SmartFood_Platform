<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // All review columns already exist
        // in create_reviews_table migration.
    }

    public function down(): void
    {
        // Nothing to rollback.
    }
};