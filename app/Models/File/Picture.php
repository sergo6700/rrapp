<?php


namespace App\Models\File;

use App\Models\Acl\User;
use App\Models\File\Traits\ElfinderFileTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Picture
 * @package App\Models\File
 */
class Picture extends Model
{
    use ElfinderFileTrait;

    /**
     * @var string
     */
    protected $table = 'pictures';

    /**
     * @var array
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'path',
        'url',
        'mimetype',
        'filename',
        'original_name',
        'size',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
