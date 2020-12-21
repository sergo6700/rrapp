<?php

namespace App\Http\Middleware;

use App\Models\Event\Event;
use App\Models\Event\AccessToEventsData;
use App\Support\Hash\HashHelper;
use Closure;

/**
 * Class CheckHash
 * @package App\Http\Middleware
 */
class CheckHash
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$hash = $request->route('hash')) {
            return redirect()->route('main.page');
        }

        /** @var Event $event */
        $event = $request->route('event');

        $thirdPartySiteEvent = AccessToEventsData::where([
            'event_id' => $event->getKey()
        ])->first();

        if (!$thirdPartySiteEvent) {
            return redirect()->route('main.page');
        }

        $hashHelper = new HashHelper();
        if (!$hashHelper->isEqual($hash, $hashHelper->compute($thirdPartySiteEvent->hash))) {
            return redirect()->route('main.page');
        }

        return $next($request);
    }
}
