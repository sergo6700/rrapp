<?php

namespace App\Http\Controllers\Web\Events;

use App\Http\Controllers\Controller;
use App\Models\Event\Event;
use Illuminate\View\View;

/**
 * Class EventStatisticsController
 * @package App\Http\Controllers\Web\Events
 */
class EventStatisticsController extends Controller
{
    /**
     * Show event statistics
     *
     * @param Event $event
     * @return View
     */
    public function index(Event $event): View
    {
        return view('web.events.statistics', ['event' => $event]);
    }
}
