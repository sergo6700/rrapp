<?php

namespace App\Models\Division;

use App\Models\Event\Event;
use App\Models\Service\Service;
use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Division
 *
 * @package App\Models\Division
 */
class Division extends Model
{
	use CrudTrait, Sluggable, SluggableScopeHelpers, SoftDeletes;

	/**
	 * @var string
	 */
	protected $table = 'divisions';

	/**
	 * @var array
	 */
	protected $fillable = [
		'name',
        'content',
        'slug',
        'position'
	];

	/**
	 * Pagination in departments list
	 *
	 * @var int
	 */
	public const PER_PAGE = 10;

	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable(): array
	{
		return [
			'slug' => [
				'source' => 'name'
			]
		];
	}

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName(): string
	{
		return 'slug';
	}

	/**
	 * Department's services
	 *
	 * @return HasMany
	 */
	public function services(): HasMany
	{
		return $this->hasMany(Service::class);
	}

	/**
	 * Department's events
	 *
	 * @return HasMany
	 */
	public function events(): HasMany
	{
		return $this->hasMany(Event::class);
	}

}
