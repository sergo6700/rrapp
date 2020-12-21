<?php
namespace App\Models\File;

use App\Models\Acl\User;
use App\Models\File\Traits\ElfinderFileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class File
 * @package App\Models\File
 * @property int id
 * @method static File firstOrCreate(array $array)
 * @method static File create(array $array)
 * @method static File find(int $int)
 * @method static Collection whereIn(string $string)
 */
class File extends Model
{
    use ElfinderFileTrait;

    /**
     * @var string
     */
    protected $table = 'files';

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

	/**
	 * Build url to watch file in browser
	 *
	 * @return string
	 */
	public function getViewUrlAttribute(): string
	{
		$params = [
			'key' => config('app.google_docs_key'),
			'embedded' => true,
			'url' => $this->url
		];

		return config('app.google_docs_url') . '?' . http_build_query($params);
    }

}
