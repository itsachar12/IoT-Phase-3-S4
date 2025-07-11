<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
{
    // Schedule summary auto
    $schedule->command('summary:buat-summary-auto')->everyTenMinutes()
        ->appendOutputTo(storage_path('logs/schedule.log'));

    // Schedule appliances check
    $schedule->command('schedule:check')->everyMinute()
        ->appendOutputTo(storage_path('logs/schedule.log'));
}


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
