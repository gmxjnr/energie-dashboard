<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    public function get()
    {
        $latest = DB::table('doel_progress')->latest()->first();

        return response()->json([
            'percentage' => $latest?->percentage ?? 0
        ]);
    }
}
