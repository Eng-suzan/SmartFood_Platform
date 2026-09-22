<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // All payment columns already exist
        // in create_payments_table migration.
    }

    public function down(): void
    {
        // Nothing to rollback.
    }
};