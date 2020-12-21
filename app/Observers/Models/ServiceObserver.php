<?php

namespace App\Observers\Models;

use App\Models\Service\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class ServiceObserver
 *
 * @package App\Observers\Models
 */
class ServiceObserver
{
	/**
	 * Handle the event "created" event.
	 *
	 * @param Service $item
	 * @return void
	 */
	public function created(Service $item)
	{
		$item->update([
			'slug' => $item->id . '-' . $item->slug
		]);
	}

    /**
     * Handle the article "updated" event.
     *
     * @param Article $article
     * @return void
     */
    public function updated(Service $service)
    {
        DB::table($service->getTable())
            ->where('id', $service->id)
            ->update(['slug' => $service->id . '-' . Str::slug($service->title)]);
    }
}
