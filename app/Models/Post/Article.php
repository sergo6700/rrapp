<?php

namespace App\Models\Post;

use App\Models\File\Picture;
use App\Support\Enum\Post\VisibilityType;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Article
 * @package App\Models\Post
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property integer|null $picture_id
 * @property integer|null $visibility_type_id
 * @property string $date
 * @property integer $view_id
 * @property boolean $fixed
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class Article extends Model
{
    use CrudTrait, Sluggable, SluggableScopeHelpers, SoftDeletes;

    /**
     * Limit text size in percent
     *
     * @var int
     */
    public const LIMIT_TEXT_SIZE_IN_PERCENT = 30; // %

    /**
     * @var int
     */
    public const PER_PAGE = 8;

    /**
     * @var int
     */
    public const COUNT_ON_MAIN_PAGE = 3;

    /**
     * @var int
     */
    public const YEAR_INTERVAL_FOR_FILTER = 15;

    /**
     * Count of similar news to show on news item details page
     */
    public const SIMILAR_COUNT = 2;

    /**
     * @var string
     */
    protected $table = 'articles';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'slug', 'title', 'description', 'content', 'visibility_type_id', 'date', 'picture_id', 'view_id', 'fixed', 'is_video'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'featured'  => 'boolean',
        'date'      => 'datetime',
    ];

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
     * @return HasOne
     */
    public function picture(): HasOne
    {
        return $this->hasOne(Picture::class, 'id', 'picture_id');
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
     * The article has full visibility.
     *
     * @return bool
     */
	public function getIsUnlimitedVisibilityAttribute(): bool
    {
        return $this->visibility_type_id === VisibilityType::FULL;
    }
}
