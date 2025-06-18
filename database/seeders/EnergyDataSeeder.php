<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EnergyDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('energy_data')->truncate(); // tabel leegmaken

        $startDate = Carbon::now()->subDays(30)->startOfDay(); // 30 dagen terug
        $endDate = Carbon::now()->endOfDay();

        $entries = [];

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            for ($time = $date->copy()->startOfDay(); $time->lte($date->copy()->endOfDay()); $time->addMinutes(15)) {
                $kwh = round(mt_rand(10, 150) / 100, 2); // 0.10 - 1.50 kWh
                $cost = round($kwh * 0.35, 2); // €0.35 per kWh

                $entries[] = [
                    'date' => $date->toDateString(),
                    'time' => $time->format('H:i:s'),
                    'consumption_kwh' => $kwh,
                    'cost_eur' => $cost,
                    'created_at' => $time,
                ];
            }
        }

        // Beter in chunks opslaan om geheugen te besparen
        foreach (array_chunk($entries, 1000) as $chunk) {
            DB::table('energy_data')->insert($chunk);
        }
    }
}
