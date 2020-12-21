<?php

namespace App\Jobs;

use App\Mail\SendReminderEmail;
use App\Models\Event\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class EventReminder
 *
 * @package App\Jobs
 */
class EventReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Sender email
     *
     * @var string $email
     */
    protected $email;

    /**
     * Message subject
     *
     * @var string
     */
    protected $subject;

    /**
     * Path to Email Blade Templates
     *
     * @var string
     */
    protected $view;

    /**
     * Model of Event
     *
     * @var Event $event
     */
    protected $event;

    /**
     * Create a new job instance.
     *
     * @param string $email
     * @param string $subject
     * @param string $view
     * @param mixed $event
     */
    public function __construct(string $email, string $subject, string $view, Event $event)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->view = $view;
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::to($this->email)
            ->send(new SendReminderEmail(
                $this->email,
                $this->subject,
                $this->view,
                $this->event
            ));
    }
}
