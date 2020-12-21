<?php

namespace App\Jobs;

use App\Mail\SendReminderEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class NewArticlesForWeek
 *
 * @package App\Jobs
 */
class NewArticlesForWeek implements ShouldQueue
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
     * Collection of articles
     *
     * @var Collection $articles
     */
    protected $articles;

    /**
     * Create a new job instance.
     *
     * @param string $email
     * @param string $subject
     * @param string $view
     * @param Collection $articles
     */
    public function __construct(string $email, string $subject, string $view, Collection $articles)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->view = $view;
        $this->articles = $articles;
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
                $this->articles
            ));
    }
}
