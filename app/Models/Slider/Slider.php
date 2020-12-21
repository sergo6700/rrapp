<?php


namespace App\Models\Slider;


use App\Models\File\Picture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\CrudTrait;

/**
 * Class Slider
 *
 * @package App\Models\Sliders
 */
class Slider extends Model
{

    use SoftDeletes, CrudTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sort',
        'link',
        'picture_desktop_id',
        'picture_mobile_id',
    ];

    /**
     * Relation with Picture (desktop)
     *
     * @return HasOne
     */
    public function picture_desktop(): HasOne
    {
        return $this->hasOne(Picture::class, 'id', 'picture_desktop_id');
    }

    /**
     * Relation with Picture (mobile)
     *
     * @return HasOne
     */
    public function picture_mobile(): HasOne
    {
        return $this->hasOne(Picture::class, 'id', 'picture_mobile_id');
    }
}