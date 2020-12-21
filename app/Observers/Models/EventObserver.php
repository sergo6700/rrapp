<?php

namespace App\Observers\Models;

use App\Models\Event\Event;
use App\Services\Admin\AccessToEventsDataService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * Class EventObserver
 *
 * @package App\Observers\Models
 */
class EventObserver
{
	/**
	 * Handle the event "created" event.
	 *
	 * @param Event $item
	 * @return void
	 */
	public function created(Event $item) :void
    {
		$item->update([
			'slug' => $item->id . '-' . $item->slug
		]);

        (new AccessToEventsDataService())->create($item);
	}

    /**
     * Handle the Event "updated" event.
     *
     * @param  Event $item
     * @return void
     */
	public function updated(Event $item) :void
    {
        DB::table($item->getTable())
            ->where('id', $item->id)
            ->update(['slug' => $item->id . '-' . Str::slug($item->title)]);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  Event  $item
     * @return void
     */
    public function deleted(Event $item) :void
    {
        $item->thirdPartySiteEvent->delete();
    }
}
