<?php

namespace App\Models\Event;

use App\Models\Address\Address;
use App\Models\Application\EventRegistration;
use App\Models\Division\Division;
use App\Models\File\File;
use Backpack\CRUD\CrudTrait;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * Class Event
 * @package App\Models\Event
 * @method static Builder orderBy(string $string, string $string1)
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $date_from
 * @property integer|null $division_id
 * @property integer|null $address_id
 * @property integer|null $visitors_count
 * @property integer|null $visited_count
 * @property integer|null $report_file_id
 * @property string|null $short_content
 * @property string|null $full_content
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $date_to
 */
class Event extends Model
{
    use CrudTrait, Sluggable, SluggableScopeHelpers, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'events';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'date_from',
        'division_id',
        'address_id',
        'visitors_count',
        'visited_count',
        'report_file_id',
        'short_content',
        'full_content',
        'date_to'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_from' => 'datetime',
        'date_to' => 'datetime',
    ];

    /**
     * Count of latest events in mini calendar on top of pages
     */
    public const LATEST_COUNT = 3;

    /**
     * Report file of event relation
     * @return HasOne
     */
    public function report_file(): HasOne
    {
        return $this->hasOne(File::class, 'id','report_file_id');
    }

    /**
     * Division of event relation
     * @return BelongsTo
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    /**
     * Address of event relation
     * @return BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    /**
     * Registation of event relation
     * @return HasMany
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class, 'event_id', 'id');
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
                'source' => 'title',
            ],
        ];
    }

    /**
     * Get event division
     * @return string
     */
    public function getDivisionName(): string
    {
        return $this->division->name;
    }

    /**
     * Get count of registered users on event
     * @return string
     */
    public function getCountRegistered(): string
    {
        return $this->registrations->count();
    }

    /**
     * Is the event passed
     *
     * @return bool
     */
    public function getPassedAttribute(): bool
    {
        return $this->date_from->isBefore(Carbon::now()->startOfDay());
    }

    /**
     * Is visitors limit is reached
     *
     * @return bool
     */
    public function getIsLimitReachedAttribute(): bool
    {
        return $this->visitors_count && $this->visitors_count === $this->registrations()->count();
    }

    /**
     * Return AccessToEventsData
     *
     * @return HasOne
     */
    public function thirdPartySiteEvent() :HasOne
    {
        return $this->hasOne('App\Models\Event\AccessToEventsData');
    }
}
