<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EnergyDataSeeder extends Seeder
{
    public function run(): void
    {
        $startDate = Carbon::now()->subDays(30);

        for ($i = 0; $i < 720; $i++) { // 24 x 30 uurmetingen
            $datetime = $startDate->copy()->addHours($i);
            $consumption = round(rand(200, 900) / 100, 2); // tussen 2.00 en 9.00 kWh
            $cost = round($consumption * 0.30, 2); // 30 cent per kWh

            DB::table('energy_data')->insert([
                'date' => $datetime->format('Y-m-d'),
                'time' => $datetime->format('H:i:s'),
                'consumption_kwh' => $consumption,
                'cost_eur' => $cost,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
