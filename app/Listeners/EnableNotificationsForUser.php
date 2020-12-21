<?php

namespace App\Listeners;

use App\Services\Web\UserService;

/**
 * Class EnableNotificationsForUser
 * @package App\Listeners
 */
class EnableNotificationsForUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        $notifications = array_map(function ($value) {
            return array_fill_keys(['type_id'], $value['id']);
        }, config('handbook.notification_types'));

        (new UserService)->updateNotifications($event->user, $notifications);
    }
}
