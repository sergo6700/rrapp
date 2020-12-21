<?php


namespace App\Support\Email;


use App\Models\Event\Event;
use Carbon\Carbon;
use App\Jobs\EventReminder as EventReminderJob;

/**
 * Class EventReminder
 *
 * @package App\Support\Email
 */
class EventReminder
{
    /**
     * Path to Email Blade Templates
     *
     * @var string
     */
    protected $view = 'emails.events.event_reminder';

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
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $events = Event::whereDate('date_from', '=', $tomorrow)
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