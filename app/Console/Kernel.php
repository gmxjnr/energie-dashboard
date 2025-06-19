<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Hier registreer je geplande taken (bijv. artisan commands).
     */
    protected function schedule(Schedule $schedule): void
    {
        // Elke minuut update doel-progress
        $schedule->command('progress:update')->everyMinute();
    }

    /**
     * Laad artisan commands uit app/Console/Commands
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
