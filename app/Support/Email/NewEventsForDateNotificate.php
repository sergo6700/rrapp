<?php

namespace App\Support\Email;

use App\Models\Acl\User;
use App\Models\Event\Event;
use Carbon\Carbon;
use App\Jobs\NewEventsForDate;

/**
 * Class NewEventsForDateNotificate
 *
 * @package App\Support\Email
 */
class NewEventsForDateNotificate
{
    /**
     * Path to Email Blade Templates
     *
     * @var string
     */
    protected $view = 'emails.events.new_events_for_date';

    /**
     * Message subject
     *
     * @var string
     */
    protected $subject = 'Новые мероприятия за ';

    /**
     * Send new events for a specific date
     *
     * @return void
     */
    public function __invoke()
    {
        $yesterday = Carbon::yesterday();
        $events = Event::whereDate('created_at', '=', $yesterday->format('Y-m-d'))->get();

        if ($events->isEmpty()) {
            return;
        }

        $emails = User::all()
            ->pluck('email')
            ->toArray();

        if (!$emails) {
            return;
        }

        $subject = $this->subject . $yesterday->format('d.m.Y');

        foreach ($emails as $email) {
            NewEventsForDate::dispatch(
                $email,
                $subject,
                $this->view,
                $events
            );
        }
    }
}