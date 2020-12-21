<?php


namespace App\Support\Email;

use Mail;

/**
 * Class EmailGateway
 *
 * @package App\Support\Email
 */
class EmailGateway
{
    /**
     * Send email with any data
     * @param array $emails
     * @param string $subject
     * @param string $text
     */
    public static function send(array $emails, string $subject, string $text): void
    {
		try {
			Mail::html($text, function ($message) use ($emails, $subject) {
				$message->subject($subject)->to($emails);
			});
		} catch (\Exception $e) {
			\Log::error($e->getMessage());
		}
    }

}
