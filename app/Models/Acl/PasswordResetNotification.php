<?php

namespace App\Models\Acl;

use Illuminate\Auth\Notifications\ResetPassword as ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class PasswordResetNotification
 *
 * @package App\Models\Acl
 */
class PasswordResetNotification extends ResetPassword
{
	/**
	 * Build the mail representation of the notification.
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		return (new MailMessage())
			->subject(trans('backpack::base.password_reset.subject'))
			->greeting(trans('backpack::base.password_reset.greeting'))
			->line([
				trans('backpack::base.password_reset.line_1'),
				trans('backpack::base.password_reset.line_2'),
			])
			->action(trans('backpack::base.password_reset.button'), route('password.reset', $this->token).'?email='.urlencode($notifiable->getEmailForPasswordReset()))
			->line(trans('backpack::base.password_reset.notice'));
	}
}
