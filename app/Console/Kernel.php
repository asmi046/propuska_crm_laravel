<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('numbers:check-numbers')->cron('25 */2 * * *')->unlessBetween('20:59', '5:00');
        $schedule->command('debtors:check-debtors')->cron('1 6 * * *');
        $schedule->command('alerts:fine')->dailyAt('10:00');
        $schedule->command('alerts:sts')->dailyAt('11:30');
        $schedule->command('alerts:to')->dailyAt('13:00');

        $schedule->command('queue:work', [
            '--max-time' => 300
            ])->withoutOverlapping();

        // $schedule->command('mtest:cron-test')->everyTwoMinutes();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
