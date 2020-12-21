<?php

namespace App\Services\Web;

use App\Models\Division\Division;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class DepartmentService
 *
 * @package App\Services\Web
 */
class DepartmentService
{
	/**
	 * Event service instance
	 *
	 * @var EventService
	 */
	protected $event_service;

	/**
	 * DepartmentService constructor.
	 *
	 * @param EventService $event_service
	 */
	public function __construct(EventService $event_service)
	{
		$this->event_service = $event_service;
	}

	/**
	 * Departments list
	 * For example, we have 4 elements with a position field: 2, 0, 1, 0.
	 * It should display: 1, 2, 0, 0.
	 * Elements with 0 - were displayed after the elements to which the number was affixed.
	 *
	 * @param array $params
	 * @return Collection
	 */
	public function index(array $params = []): LengthAwarePaginator
	{
		// SQL queries
		$priorityQuery = Division::where('position', '>', 0)->orderBy('position', 'ASC')->latest();
		$secondaryQuery = Division::where('position', '=', 0)->latest();

		// get a collections
		$priorityCollection = $priorityQuery->get();
		$secondaryCollection = $secondaryQuery->get();

        $unionCollection = $priorityCollection->merge($secondaryCollection);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $paginator = new LengthAwarePaginator(
            $unionCollection->forPage($currentPage, Division::PER_PAGE),
            $unionCollection->count(),
            Division::PER_PAGE,
            $currentPage,
            [
                'path' => route('department'),
            ]
        );

        return $paginator->appends($params);
	}

	/**
	 * Load info for specific department
	 *
	 * @param Division $item
	 * @return Division
	 */
	public function load(Division $item): Division
	{
		$item->loadMissing(['services', 'events' => function ($query) {
			$now = Carbon::now()->startOfDay()->toDateTimeString();

			$query->oldest('date_from')->where('date_to', '>=', $now)->orWhere(function ($query) use ($now) {
				$query->whereNull('date_to')->where('date_from', '>=', $now);
			});
		}]);

		$item->events_by_date = $this->event_service->groupByDate($item->events);

		return $item;
	}
}
