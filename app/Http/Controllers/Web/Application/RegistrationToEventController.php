<?php


namespace App\Http\Controllers\Web\Application;

use App\Http\Requests\Web\Application\RegistrationToEventCreateRequest;
use App\Models\Event\Event;
use App\Services\Web\RegistrationToEventService;
use Illuminate\Http\RedirectResponse;

/**
 * Class RegistrationToEventController
 *
 * @package App\Http\Controllers\Web\Application
 */
class RegistrationToEventController
{
	protected $registrationToEventService;

	/**
	 * RegistrationToEventController constructor.
	 *
	 * @param RegistrationToEventService $registrationToEventService
	 */
	public function __construct(RegistrationToEventService $registrationToEventService)
	{
		$this->registrationToEventService = $registrationToEventService;
	}

	/**
	 * Cancel registration to event
	 *
	 * @param Event $event
	 * @return RedirectResponse
	 */
	public function destroy(Event $event): RedirectResponse
	{
		$this->registrationToEventService->destroy($event);

		return redirect()->back();
	}

	/**
	 * Cancel registration to event
	 *
	 * @param RegistrationToEventCreateRequest $request
	 * @return RedirectResponse
	 */
	public function create(RegistrationToEventCreateRequest $request): RedirectResponse
	{
		$this->registrationToEventService->create($request->only('event_id'), auth()->user()->id);

		return redirect()->back()->with('CompleteRegistration', true);
	}
}
