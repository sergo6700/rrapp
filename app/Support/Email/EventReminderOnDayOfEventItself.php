<?php


namespace App\Support\Email;

use App\Jobs\EventReminder as EventReminderJob;
use App\Models\Event\Event;
use Carbon\Carbon;

/**
 * Class EventReminderOnDayOfEventItself
 *
 * @package App\Support\Email
 */
class EventReminderOnDayOfEventItself
{
    /**
     * Path to Email Blade Templates
     *
     * @var string
     */
    protected $view = 'emails.events.event_reminder_on_day_of_event_itself';

    /**
     * Message subject
     *
     * @var string
     */
    protected $subject = 'Напоминания о мероприятии ';

    /**
     * Send email with upcoming event reminder
     *
     * @return void
     */
    public function __invoke()
    {
        $now = Carbon::now()->format('Y-m-d');

        $events = Event::whereDate('date_from', '=', $now)
            ->whereHas('registrations')
            ->get();

        foreach ($events as $event) {
            foreach ($event->registrations as $registration) {
                $subject = $this->subject.$event->title;

                EventReminderJob::dispatch(
                    $registration->user->email,
                    $subject,
                    $this->view,
                    $event
                );
            }
        }
    }
}