<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $vandaag = Carbon::today();

        $energyData = DB::table('energy_data')
            ->whereDate('created_at', $vandaag)
            ->orderBy('created_at')
            ->get();

        $labels = [];
        $kwhData = [];
        $kostenData = [];

        foreach ($energyData as $data) {
            $labels[] = Carbon::parse($data->created_at)->format('H:i');
            $kwhData[] = $data->consumption_kwh ?? 0;
            $kostenData[] = $data->cost_eur ?? 0;
        }

        // Stel dat je doel 50kWh is voor deze week:
        $huidigeWeek = DB::table('energy_data')
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->sum('consumption_kwh');

        $doelWeek = 50; // bijv. 50kWh
        $doelPercentage = min(round(($huidigeWeek / $doelWeek) * 100, 1), 100);

        return view('dashboard.home', compact(
            'labels',
            'kwhData',
            'kostenData',
            'doelPercentage'
        ));
    }
}
