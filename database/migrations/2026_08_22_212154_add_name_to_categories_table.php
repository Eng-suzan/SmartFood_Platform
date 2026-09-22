<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // The name column already exists
        // in create_categories_table migration.
    }

    public function down(): void
    {
        // Nothing to rollback.
    }
};