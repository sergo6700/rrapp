<?php


namespace App\Models\Docs;

use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * @package App\Models\Docs
 * @method static Document find(int $int)
 */
class Document extends Model
{
	use CrudTrait, Sluggable, SluggableScopeHelpers;

    /**
     * @var string
     */
    protected $table = 'documents';

    /**
     * @var int
     */
    public const COUNT_ON_MAIN_PAGE = 3;

	/**
	 * Pagination in documents list
	 *
	 * @var int
	 */
	public const PER_PAGE = 11;

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'content'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function files() {
        return $this->morphToMany('App\Models\File\File', 'model', 'model_file');
    }

	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable(): array
	{
		return [
			'slug' => [
				'source' => 'name',
			],
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

}
