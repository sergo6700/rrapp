<?php

namespace App\Observers\Models;

use App\Models\Post\NewsItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class NewsItemObserver
 *
 * @package App\Observers\Models
 */
class NewsItemObserver
{
	/**
	 * Handle the News "created" event.
	 *
	 * @param NewsItem $item
	 * @return void
	 */
	public function created(NewsItem $item)
	{
		$item->update([
			'slug' => $item->id . '-' . $item->slug
		]);
	}

    /**
     * Handle the News "updated" event.
     *
     * @param NewsItem $item
     * @return void
     */
    public function updated(NewsItem $item)
    {
        DB::table($item->getTable())
            ->where('id', $item->id)
            ->update(['slug' => $item->id . '-' . Str::slug($item->title)]);
    }
}
