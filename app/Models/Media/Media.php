<?php

namespace App\Models\Media;

use App\Models\File\Picture;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Media
 * @package App\Models\Media
 * @property integer $id
 * @property string $description
 * @property integer $picture_id
 * @property string $link
 * @property boolean $fixed
 *
 */
class Media extends Model
{
    use CrudTrait, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'media';

    /**
     * @var array
     */
    protected $fillable = [
        'description',
        'picture_id',
        'link',
        'fixed'
    ];

    /**
     * Pagination in news list
     *
     * @var int
     */
    public const PER_PAGE = 6;

    /**
     * @return HasOne
     */
    public function picture(): HasOne
    {
        return $this->hasOne(Picture::class, 'id', 'picture_id');
    }
}
