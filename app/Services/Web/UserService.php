<?php


namespace App\Services\Web;

use App\Models\Acl\User;
use Auth;

/**
 * Class UserService
 * @package App\Services\Web
 */
class UserService
{
    /**
     * Update user profile information
     * @param array $array
     */
    public function update(array $array): void
    {
        $hasEemailHasChanged = false;
        if ($this->emailHasChanged($array)) {
            $hasEemailHasChanged = true;
        }

        Auth::user()->update($array);

        if ($hasEemailHasChanged) {
            $this->resendEmailVerification();
        }
    }

    /**
     * Resend confirmation email
     *
     * @return void
     */
    public function resendEmailVerification(): void
    {
        $user = Auth::user();
        $user->update(['email_verified_at' => null]);

        $user->sendEmailVerificationNotification();
    }

    /**
     * Check email has been changed?
     *
     * @param array $array
     * @return bool
     */
    public function emailHasChanged(array $array): bool
    {
        if (!array_key_exists('email', $array)) {
            throw new \DomainException('Missing required "email" key');
        }

        return $array['email'] !== Auth::user()->email;
    }

	/**
	 * User's info
	 *
	 * @param User $user
	 * @return User
	 */
	public function load(User $user): User
	{
		return $user->loadMissing(['events', 'notifications']);
    }

	/**
	 * Update user's notifications
	 *
	 * @param User $user
	 * @param array $notifications
	 * @return void
	 */
	public function updateNotifications(User $user, array $notifications): void
	{
		$user->notifications()->delete();
		$user->notifications()->createMany($notifications);
    }

}
