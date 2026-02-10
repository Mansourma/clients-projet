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
        $schedule->command('app:update-service-status')->everyMinute();
        $schedule->command('services:archive')->monthlyOn(28, '23:59');
        $schedule->command('reminders:send-subscription')->daily();
        $schedule->command('send-payment-reminders')->daily();
        $schedule->command('orders:generate')->everyMinute();
        $schedule->command('app:non-subscribed-service-order')->everyMinute();
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
