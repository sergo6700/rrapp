<?php

namespace App\Models\Post;

use App\Models\File\Picture;
use App\Support\Enum\Post\VisibilityType;
use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class NewsItem
 *
 * @package App\Models
 *
 * @property integer      $id
 * @property string       $title
 * @property string       $slug
 * @property string       $content
 * @property integer|null $picture_id
 * @property integer|null $visibility_type_id
 * @property string       $date
 * @property boolean      $fixed
 * @property string|null  $created_at
 * @property string|null  $updated_at
 * @property string|null  $deleted_at
 */
class NewsItem extends Model
{
    use CrudTrait, Sluggable, SluggableScopeHelpers, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'title', 'description', 'content', 'visibility_type_id', 'date', 'picture_id', 'fixed'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Count of latest news in mini calendar on top of pages
     */
    public const LATEST_COUNT = 3;

    /**
     * Count of visible symbols for news with partial visibility
     *
     * @var int
     */
    public const SHORT_TEXT_SIZE = 800;

    /**
     * Pagination in news list
     *
     * @var int
     */
    public const PER_PAGE = 8;

    /**
     * Count of similar news to show on news item details page
     */
    public const SIMILAR_COUNT = 2;


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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Picture related to model
     *
     * @return HasOne
     */
    public function picture(): HasOne
    {
        return $this->hasOne(Picture::class, 'id', 'picture_id');
    }

    /**
     * Has full visibility
     *
     * @return bool
     */
    public function getIsFullVisibilityAttribute(): bool
    {
        return $this->visibility_type_id === VisibilityType::FULL;
    }

    /**
     * Has partial visibility
     *
     * @return bool
     */
    public function getIsPartialVisibilityAttribute(): bool
    {
        return $this->visibility_type_id === VisibilityType::PARTIAL;
    }

    /**
     * Has closed visibility
     *
     * @return bool
     */
    public function getIsClosedVisibilityAttribute(): bool
    {
        return $this->visibility_type_id === VisibilityType::AUTH_ONLY;
    }

    /**
     * The piece of news has full visibility.
     *
     * @return bool
     */
    public function getIsUnlimitedVisibilityAttribute(): bool
    {
        return $this->visibility_type_id === VisibilityType::FULL;
    }
}
