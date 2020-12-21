<?php

namespace App\Http\Controllers\Web\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Event\EventListRequest;
use App\Models\PageMetadata\PageMetadata;
use App\Services\Web\EventService;
use App\Support\Seo\SeoUtils;
use Illuminate\View\View;

/**
 * Class EventController
 *
 * @package App\Http\Controllers\Web\Events
 */
class EventController extends Controller
{
	/**
	 * Event service instance
	 *
	 * @var EventService
	 */
	protected $event_service;

	/**
	 * EventController constructor.
	 *
	 * @param EventService $event_service
	 */
	public function __construct(EventService $event_service)
	{
		$this->event_service = $event_service;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param EventListRequest $request
	 * @return View
     * @throws \ReflectionException
	 */
	public function index(EventListRequest $request): View
	{
		$events = $this->event_service->index($request->all() + [
				'limit' => config('events_list_limit'),
			]);

		$data = $this->event_service->groupByDate($events);

		$type = ($request->has(['past']) && $request->input('past'))
            ? PageMetadata::PAST_EVENTS_ALIAS
            : PageMetadata::UPCOMING_EVENTS_ALIAS;
        $seoUtils = new SeoUtils($type);

		return view('web.events.index')->with([
				'data' => $data,
				'title' => $seoUtils->getTitle(),
				'description' => $seoUtils->getDescription(),
			] + $request->only(['past']));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param string $slug
	 * @return View
	 */
	public function show(string $slug): View
	{
		$event = $this->event_service->findBySlug($slug);

		return view('web.events.show')->with(compact('event'));
	}
}
