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
        Schema::table('employees', function (Blueprint $table) {
            // Schema::table() → MODIFY existing table
            // NOT Schema::create() → that would try to CREATE a new table

            $table->string('MiddleName', 50)
                ->nullable()
                ->after('FirstName');
            // nullable → middle name is optional
            // after('FirstName') → inserts column AFTER FirstName
            // column order: FirstName, MiddleName, LastName

            $table->string('Address', 200)
                ->nullable()
                ->after('ContactNumber');
            // nullable → address might not always be available
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['MiddleName', 'Address']);
            // down() removes what up() added
            // dropColumn() on rollback
        });

    }
};
