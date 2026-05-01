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
        Schema::table('deliveries', function (Blueprint $table) {
            $table->string('SupplierName', 100)
                ->nullable()
                ->after('SupplierID');
            // Stores the CONTACT PERSON for this specific delivery
            // Independent from suppliers table — won't change if supplier record changes
        });
    }

    public function down(): void
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropColumn('SupplierName');
        });
    }
};
