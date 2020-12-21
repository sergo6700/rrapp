<?php


namespace App\Support\Email;

use App\Models\Acl\User;
use App\Models\Post\Article;
use Carbon\Carbon;
use App\Jobs\NewArticlesForWeek;

/**
 * Class NewArticlesNotificate
 *
 * @package App\Support\Email
 */
class NewArticlesNotificate
{
    /**
     * Path to Email Blade Templates
     *
     * @var string
     */
    protected $view = 'emails.articles.new_articles';

    /**
     * Message subject
     *
     * @var string
     */
    protected $subject = 'Новые статьи за неделю';

    /**
     * Send email with list of new articles for the week
     *
     * @return void
     */
    public function __invoke()
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week_tm = strtotime("last monday midnight", $previous_week);
        $start_week = Carbon::createFromTimestamp($start_week_tm)->toDateString();

        $end_week_tm = strtotime("+6 day", $start_week_tm);
        $end_week = Carbon::createFromTimestamp($end_week_tm)->toDateString();

        $articles = Article::whereBetween('date', [$start_week, $end_week])->get();

        if ($articles->isEmpty()) {
            return;
        }

        $emails = User::all()
            ->pluck('email')
            ->toArray();

        if (!$emails) {
            return;
        }

        foreach ($emails as $email) {
            NewArticlesForWeek::dispatch(
                $email,
                $this->subject,
                $this->view,
                $articles
            );
        }
    }
}