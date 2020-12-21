<?php


namespace App\Services\Web;


use App\Models\Application\EventRegistration;
use App\Models\Event\Event;
use Auth;

/**
 * Class RegistrationToEventService
 *
 * @package App\Services\Web
 */
class RegistrationToEventService
{

	/**
	 * Cancel registration to event
	 *
	 * @param Event $event
	 * @return void
	 */
	public function destroy(Event $event): void
	{
		EventRegistration::query()->where('user_id', Auth::user()->id)
			->where('event_id', $event->id)->delete();
	}

	/**
	 * Cancel registration to event
	 *
	 * @param array $array
	 * @param int $userId
	 * @return void
	 */
	public function create(array $array, int $userId): void
	{
		if (EventRegistration::query()
				->where('event_id', $array['event_id'])
				->where('user_id', $userId)->count() === 0) {
			EventRegistration::query()->create(['event_id' => $array['event_id'], 'user_id' => $userId]);
		}
	}

}
