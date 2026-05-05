<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
        $table->softDeletes();
        // Adds a 'deleted_at' nullable timestamp column
        // When a supplier is "deleted", Laravel sets this to current timestamp
        // When null → supplier is active
        // When filled → supplier is archived (soft deleted)
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
        $table->dropSoftDeletes();
    });

    }
};
