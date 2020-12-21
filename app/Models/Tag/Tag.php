<?php

namespace App\Models\Tag;

use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Tag
 * @property string name
 * @property string slug
 * @package App\Models\Tag
 */
class Tag extends Model
{
    /**
     * @var string
     */
    protected $table = 'tags';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * Services of tag relation
     * @return BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->morphedByMany(Service::class, 'taggable');
    }
}
