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
        Schema::create('tanks', function (Blueprint $table) {
            $table->id('TankID');
            $table->unsignedBigInteger('FuelID');
            $table->decimal('MaxCapacity', 10, 2);
            // Maximum liters the tank can hold
            // e.g. 10000.00 liters
            $table->decimal('CurrentCapacity', 10, 2)->default(0.00);
            // Current liters in the tank
            // Starts at 0, goes up when delivery is recorded
            $table->timestamps();

            $table->foreign('FuelID')
                ->references('FuelID')
                ->on('fuels')
                ->onDelete('restrict');
            // restrict → cannot delete a fuel type that has a tank
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanks');
    }
};
