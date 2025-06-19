<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateDoelProgress extends Command
{
    protected $signature = 'progress:update';
    protected $description = 'Voegt nieuw doel-progress percentage toe';

    public function handle()
    {
        $percentage = rand(10, 100); // willekeurig percentage

        DB::table('doel_progress')->insert([
            'percentage' => $percentage,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->info("Doel progress geüpdatet naar $percentage%");
    }
}
