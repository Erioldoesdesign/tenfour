<?php

namespace RollCall\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \RollCall\Console\Commands\Inspire::class,
        \RollCall\Console\Commands\ReceiveSMS::class,
        \RollCall\Console\Commands\ImportContacts::class,
        \RollCall\Console\Commands\ResendRollCall::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Disable pulling SMS, this doesn't work well with multiple providers
        // $schedule->command(\RollCall\Console\Commands\ReceiveSMS::class)
        //          ->everyMinute();
    }
}
