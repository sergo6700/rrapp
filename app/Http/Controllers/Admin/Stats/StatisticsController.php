<?php


namespace App\Http\Controllers\Admin\Stats;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Stats\ServicesActivityTableRequest;
use App\Http\Requests\Admin\Stats\NewUsersTableRequest;
use App\Models\Acl\User;
use App\Models\Event\Event;
use App\Models\Service\Service;
use Carbon\Carbon;

/**
 * Class StatisticsController
 * @package App\Http\Controllers\Admin\Stats
 */
class StatisticsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $eventsActivityRecords = [];

        $events = Event::orderBy('date_from', 'DESC')
            ->where('date_to', '<', Carbon::now()->toDateString())
			->orWhere(function ($query) {
				$query->whereNull('date_to')->where('date_from', '<', Carbon::now()->toDateString());
			})
            ->get();

        foreach ($events as $event) {
            $eventsActivityRecords[] = [
                'title' => $event->title,
                'date' =>  Carbon::parse($event->date_from)->toDateString(),
                'registrations_count' => $event->registrations->count(),
                'visited_count' => intval($event->visited_count)
            ];
        }

        return view('admin.stats.statistics', [
            'totalUsersCount' => User::count(),
            'eventsActivityRecords' => $eventsActivityRecords
        ]);
    }

    /**
     * For AJAX requests
     * @param NewUsersTableRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newUsersTable(NewUsersTableRequest $request)
    {
        $year = $request->year ? intval($request->year) : Carbon::now()->year;
        $month = $request->month ? intval($request->month) : intval(Carbon::now()->format('m'));

        $date = Carbon::parse($year . '-' . $month);
        $date->setDay(Carbon::now()->day);

        $thisWeek = $date->copy()->startOfWeek();

        return view('admin.stats.tables.new_users', [
            'newUsers'  => [
                'today'     => User::whereBetween('created_at', [
                    Carbon::now()->startOfDay(), Carbon::now()->endOfDay()
                ])
                    ->count(),
                'this_week' => User::whereBetween('created_at', [
                    $thisWeek, Carbon::today()->endOfDay()
                ])
                    ->count(),
                'month'     => User::whereBetween('created_at', [
                    $date->copy()->startOfMonth(), $date->copy()->endOfMonth()
                ])
                    ->count()
            ],
            'monthName' => config('lang.months')[$month],
            'month'     => $month,
            'year'      => $year
        ]);
    }

    /**
     * For AJAX requests
     * @param ServicesActivityTableRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function servicesActivityTable(ServicesActivityTableRequest $request)
    {
        $year = $request->year ? intval($request->year) : Carbon::now()->year;
        $month = $request->month ? intval($request->month) : intval(Carbon::now()->format('m'));

        $date = Carbon::parse($year . '-' . $month);
        $date->setDay(Carbon::now()->day);

        $records = [];

        $startOfToday = Carbon::now()->startOfDay();
        $startOfWeek = Carbon::now()->startOfWeek();

        foreach (Service::orderBy('id', 'DESC')->get() as $service) {
            $applications = $service->applications;

            $records[] = [
                'title'     => $service->title,
                'today'     => $applications
                    ->whereBetween('updated_at', [$startOfToday, $startOfToday->copy()->endOfDay()])
                    ->count(),
                'this_week' => $applications
                    ->whereBetween('updated_at', [$startOfWeek, $startOfWeek->copy()->endOfWeek()])
                    ->count(),
                'month'     => $applications
                    ->whereBetween('updated_at', [
                        $date->copy()->startOfMonth(), $date->copy()->endOfMonth()
                    ])
                    ->count()
            ];
        }

        return view('admin.stats.tables.services_activity', [
            'monthName' => config('lang.months')[$month],
            'month'     => $month,
            'year'      => $year,
            'records'   => $records
        ]);
    }
}
