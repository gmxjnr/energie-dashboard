<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function home()
    {
        return view('dashboard.home');
    }

    public function analyse()
    {
        return view('dashboard.analyse');
    }

    public function energiebespaar()
    {
        return view('dashboard.energiebespaar');
    }

    public function instellingen()
    {
        return view('dashboard.instellingen');
    }

    public function inzichtData($periode)
    {
        $baseQuery = DB::table('energy_data');

        switch ($periode) {
            case 'dag':
                $baseQuery->whereDate('date', now()->toDateString());
                break;
            case 'week':
                $baseQuery->whereBetween('date', [
                    now()->startOfWeek()->toDateString(),
                    now()->endOfWeek()->toDateString()
                ]);
                break;
            case 'maand':
                $baseQuery->whereMonth('date', now()->month)
                          ->whereYear('date', now()->year);
                break;
            default:
                return response()->json(['error' => 'Ongeldige periode'], 400);
        }

        // Maak aparte queries aan om de builder niet te verstoren
        $gemiddeldeData = (clone $baseQuery)->selectRaw('
            AVG(active_power_kwh) as avg_active,
            AVG(stored_energy_kwh) as avg_stored
        ')->first();

        $totaalVerbruik = (clone $baseQuery)->sum('consumption_kwh');

        $piekMoment = (clone $baseQuery)
            ->whereNotNull('peak_power_kwh')
            ->orderByDesc('peak_power_kwh')
            ->first();

        return response()->json([
            'actief_verbruik' => round($gemiddeldeData->avg_active ?? 0, 2),
            'opgeslagen_energie' => round($gemiddeldeData->avg_stored ?? 0, 2),
            'totaal_verbruik' => round($totaalVerbruik ?? 0, 2),
            'piekverbruik' => $piekMoment ? [
                'tijd' => $piekMoment->time,
                'waarde' => round($piekMoment->peak_power_kwh, 2)
            ] : null
        ]);
    }
}
