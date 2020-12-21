<?php

namespace App\Observers\Models;


use App\Models\Docs\Document;

/**
 * Class DocumentObserver
 *
 * @package App\Observers\Models
 */
class DocumentObserver
{
	/**
	 * Handle the document "created" event.
	 *
	 * @param Document $item
	 * @return void
	 */
	public function created(Document $item)
	{
		$item->update([
			'slug' => $item->id . '-' . $item->slug
		]);
	}

}
