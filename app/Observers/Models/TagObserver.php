<?php

namespace App\Observers\Models;

use App\Models\Tag\Tag;
use Illuminate\Support\Str;

/**
 * Class TagObserver
 *
 * @package App\Observers\Models
 */
class TagObserver
{
	/**
	 * Handle the tag models file file "creating" event.
	 *
	 * @param Tag $model
	 * @return void
	 */
	public function creating(Tag $model): void
	{
		$model->slug = Str::slug($model->name);
	}

	/**
	 * Handle the app models file file "created" event.
	 *
	 * @param Tag $model
	 * @return void
	 */
	public function created(Tag $model): void
	{
		$model->update([
			'slug' => $model->id . '-' . $model->slug
		]);
	}

}
