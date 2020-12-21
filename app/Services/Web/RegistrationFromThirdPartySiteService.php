<?php


namespace App\Services\Web;

use App\Models\Acl\User;
use App\Models\Event\Event;

/**
 * Class RegistrationFromThirdPartySiteService
 * @package App\Services\Web
 */
class RegistrationFromThirdPartySiteService
{
    /**
     * Has the maximum number of participants been reached?
     *
     * @return bool
     */
    public function isLimitReached(Event $event) :bool
    {
        return $event->is_limit_reached;
    }


    /**
     * Register new user
     *
     * @param Event $event
     * @param array $data
     */
    public function register(Event $event, array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'tin' => $data['tin'],
        ]);

        $registrationtoevent_service = new RegistrationToEventService;
        $registrationtoevent_service->create(
            ['event_id' => $event->id],
            $user->id
        );
    }
}
