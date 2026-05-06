<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // add_soft_delete_to_tanks_table
public function up(): void
{
    Schema::table('tanks', function (Blueprint $table) {
        $table->softDeletes();
    });
}
public function down(): void
{
    Schema::table('tanks', function (Blueprint $table) {
        $table->dropSoftDeletes();
    });
}
};
