<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SendReminderEmail
 *
 * @package App\Mail
 */
class SendReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

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
    public $subject;

    /**
     * Path to Email Blade Templates
     *
     * @var string
     */
    public $view;

    /**
     * Data collection | Eloquent
     *
     * @var mixed $data
     */
    protected $data;

    /**
     * Config
     *
     * @var array $config
     */
    protected $config;

    /**
     * Create a new message instance.
     *
     * NewEventsForDate constructor.
     * @param string $email
     * @param string $subject
     * @param $view
     * @param mixed $data
     * @return void
     */
    public function __construct(string $email, string $subject, string $view, $data)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->view = $view;
        $this->data = $data;
        $this->config  = config('mail');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->config['from']['address'])
            ->to($this->email)
            ->subject($this->subject)
            ->view($this->view, ['data' => $this->data]);
    }
}
