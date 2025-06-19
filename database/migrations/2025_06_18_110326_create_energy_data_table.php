<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('energy_data', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Datum van meting
            $table->time('time'); // Tijdstip
            $table->float('consumption_kwh'); // Verbruik in kWh
            $table->float('cost_eur'); // Kosten in euro's

            // Toegevoegde kolommen
            $table->float('stored_energy_kwh')->default(0);   // opgeslagen energie in kWh
            $table->float('active_power_kwh')->default(0);    // huidig actief vermogen in W
            $table->float('peak_power_kwh')->default(0);      // piekverbruik in kWh

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('energy_data');
    }
};
