<?php


namespace App\Services\Web;


use App\Models\Event\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

/**
 * Class EventService
 * @package App\Services\Web
 */
class EventService extends AbstractService
{
    const ROUTE_NAME = 'event.show';

    /**
     * Apply past parameter to events list
     *
     * @param Builder $query
     * @param bool|null $past
     * @return Builder
     */
    protected function applyPastFilter(Builder $query, ?bool $past): Builder
    {
        $query->when($past ?? null, function ($query) {
            $query->where('date_to', '<', Carbon::now()->format('Y-m-d'))
                ->orWhere(function ($query) {
                    $query->whereNull('date_to')->where('date_from', '<', Carbon::now()->toDateString());
                })
                ->orderByDesc('date_from');
        }, function ($query) {
            $query->where('date_from', '>=', Carbon::now()->format('Y-m-d'))
                ->orWhere(function ($query) {
                    $query->whereNull('date_to')->where('date_from', '>=', Carbon::now()->toDateString());
                })
                ->orderBy('date_from');
        });

        return $query;
    }

    /**
     * Form date period array for filter in events list
     *
     * @param int|null $year
     * @param int|null $month
     * @return array
     */
    protected function formPeriod(int $year = null, int $month = null): array
    {
        $year = $year ?? Carbon::now()->year;

        $month_start = $month ?? Carbon::now()->startOfYear()->month;
        $month_end = $month ?? Carbon::now()->endOfYear()->month;

        return [
            Carbon::create($year, $month_start)->startOfMonth()->startOfDay()->format('Y-m-d H:i:s'),
            Carbon::create($year, $month_end)->endOfMonth()->endOfDay()->format('Y-m-d H:i:s')
        ];
    }

    /**
     * Apply date filter to events list
     *
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    protected function applyDateFilter(Builder $query, array $params): Builder
    {
        $query->when($params['year'] ?? null, function ($query, $year) use ($params) {

            $query->when($params['month'] ?? null, function ($query, $month) use ($year) {

                $period = $this->formPeriod($year, $month);
                $query->whereBetween('date_from', $period)->orWhereBetween('date_to', $period);

            }, function ($query) use ($year) {

                $period = $this->formPeriod($year, null);
                $query->whereBetween('date_from', $period)->orWhereBetween('date_to', $period);

            });
        }, function ($query) use ($params) {

            $query->when($params['month'] ?? null, function ($query, $month) {

                $period = $this->formPeriod(null, $month);
                $query->whereBetween('date_from', $period)->orWhereBetween('date_to', $period);

            });
        });

        return $query;
    }

    /**
     * Get events by ids and filter by past and future
     * @param array $array
     * @return array
     */
    public function getFiltredEvents(array $array): array
    {
        $events = Event::query()->with(['division', 'address'])->whereIn('id', $array)
            ->orderBy('date_from')->get();
        $currentTime = Carbon::now();
        $date = $currentTime->toDateTimeString();
        $past_events = $events->where('date_from', '<', $date);
        $future_events = $events->where('date_from', '>=', $date);

        return [
            'past_events' => $past_events,
            'future_events' => $future_events,
        ];
    }

    /**
     * Get events for main page
     * @return array
     */
    public function getEventsForMainPage(): array
    {
        $currentTime = Carbon::now();
        $date = $currentTime->toDateTimeString();
        $temp_events = Event::query()->with(['division', 'address'])->where('date_from', '>=', $date)
            ->orderBy('date_from')->get()->toArray();
        $events_grouped_by_date = [];
        foreach ($temp_events as $event) {
            $format_date = Carbon::parse($event['date_from'])->format('d-m-Y');

            if (!isset($events_grouped_by_date[$format_date])) {
                $cnt = 0;
                $events_grouped_by_date[$format_date] = [];
            }

            if (isset($events_grouped_by_date[$format_date])) {
                if ($cnt === 4) {
                    continue;
                }
                $events_grouped_by_date[$format_date][$event['id']] = $event;
                $cnt++;
            }
        }

        return $events_grouped_by_date;
    }

    /**
     * Events list
     *
     * @param array $params
     * @return Collection
     */
    public function index(array $params): Collection
    {
        $query = Event::with(['division', 'address']);

        $this->applyDateFilter($query, $params);

        $query->when(!($params['year'] ?? null ) && !($params['month'] ?? null), function ($query) use ($params) {
            $this->applyPastFilter($query, $params['past'] ?? null);
        });

        $query->when($params['limit'] ?? null, function ($query, $limit) {
            $query->limit($limit);
        });

        return $query->get();
    }

    /**
     * Form array to use in template
     *
     * @param Collection $events
     * @return array
     */
    public function groupByDate(Collection $events): array
    {
        $result = [];

        foreach ($events as $event) {
            $result[$event->date_from->format('Y-m-d')][] = $event;
        }

        return $result;
    }

    /**
     * Find event by slug
     *
     * @param string $slug
     * @return Event
     */
    public function findBySlug(string $slug): Event
    {
        return Event::where(compact('slug'))
            ->with(['address', 'division'])
            ->first();
    }

    /**
     * Get latest events for mini calendar on top of pages
     *
     * @return Collection
     */
    public function getLatestForFixedBlock(): Collection
    {
        $query = Event::whereDate('date_to', '>=', date('Y-m-d'))
            ->orWhere(function ($query) {
                $query->whereNull('date_to')->whereDate('date_from', '>=', date('Y-m-d'));
            })
            ->oldest('date_from')
            ->limit(Event::LATEST_COUNT);

        if (strpos($this->current_route, self::ROUTE_NAME) !== false) {
            try {
                $event_slug = \Request::route()->parameter('slug');
                $event = $this->findBySlug($event_slug);

                return $query->where('id', '!=', $event->id)->get();
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
            }
        }

        return $query->get();
    }

}
