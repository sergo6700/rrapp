<?php

namespace App\Models\Service;

use App\Models\Division\Division;
use App\Models\Email\Email;
use App\Models\Application\Application;
use App\Models\Tag\Tag;
use App\Support\Service\ServiceHelper;
use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * Class Email
 * @package App\Models\Email
 * @method static Builder orderBy(string $string, string $string1)
 *
 * @property integer $id
 * @property integer $division_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $short_content
 * @property string $full_content
 * @property integer $position
 * @property integer $is_show_on_main
 */
class Service extends Model
{
	use CrudTrait, Sluggable, SluggableScopeHelpers, SoftDeletes;

	/**
     * @var string
     */
    protected $table = 'services';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'division_id',
        'short_content',
        'full_content',
        'is_show_on_main',
		'slug',
        'description',
        'position'
    ];

	/**
	 * Count of latest events in mini calendar on top of pages
	 */
	public const LATEST_COUNT = 3;

	/**
	 * Count of services per page in services list
	 */
	public const PER_PAGE = 9;

	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable(): array
	{
		return [
			'slug' => [
				'source' => 'title'
			]
		];
	}

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'slug';
	}

    /**
     * Division of service relation
     * @return BelongsTo
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }


    /**
     * Application of service relation
     * @return HasMany
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'service_id', 'id');
    }

    /**
     * Tags of service relation
     * @return MorphToMany
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Emails of service relation
     * @return MorphToMany
     */
    public function emails(): MorphToMany
    {
        return $this->morphToMany(Email::class, 'emailable');
    }

    /**
     * Get division name
     * @return string
     */
    public function getDivisionName(): string
    {
        return $this->division->name ?? '';
    }

    /**
     * Get service emails
     * @return string
     */
    public function getEmails(): string
    {
        return implode(', ', $this->emails->pluck('email')->toArray()) ?? '';
    }

    /**
     * Get total service applications count
     * @return string
     */
    public function getTotalApplications(): string
    {
        return ServiceHelper::getTotalApplicationsLink($this);
    }

    /**
     * Get new service applications count
     * @return string
     */
    public function getNewApplications(): string
    {
        return ServiceHelper::getNewApplicationsLink($this);
    }

}
