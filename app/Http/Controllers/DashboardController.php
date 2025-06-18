<?php

namespace App\Http\Controllers;

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
}
