<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserSource
 * @package App\Models\Acl
 *
 * @property int $id
 * @property int $user_id
 * @property int $source
 */
class UserSource extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'user_sources';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'source'
    ];

    /**
     * Return User model
     *
     * @return BelongsTo
     */
    public function user() :BelongsTo
    {
        return $this->belongsTo('App\Models\Acl\User');
    }
}
