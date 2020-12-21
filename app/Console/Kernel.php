<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Support\Email\NewArticlesNotificate;
use App\Support\Email\NewEventsForDateNotificate;
use App\Support\Email\EventReminder;
use App\Support\Email\EventReminderOnDayOfEventItself;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(new NewArticlesNotificate)
                ->weekly()
                ->mondays()
                ->at('10:00');

        $schedule->call(new NewEventsForDateNotificate)
            ->dailyAt('10:00');

        $schedule->call(new EventReminder)
            ->dailyAt('10:00');

        $schedule->call(new EventReminderOnDayOfEventItself)
            ->dailyAt('09:00');

        $schedule->command('sitemap:generate')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
