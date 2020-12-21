<?php

namespace App\Observers\Models;

use App\Models\Division\Division;

/**
 * Class DivisionObserver
 *
 * @package App\Observers\Models
 */
class DivisionObserver
{
	/**
	 * Handle the division "created" event.
	 *
	 * @param Division $item
	 * @return void
	 */
	public function created(Division $item)
	{
		$item->update([
			'slug' => $item->id . '-' . $item->slug
		]);
	}

}
