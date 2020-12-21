<?php

namespace App\Models\Pages;

use Illuminate\Support\Str;
use Backpack\PageManager\app\Models\Page as CrudPage;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property integer $template_id
 * @property string $name
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $extras
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property PageTemplate $pageTemplate
 */
class Page extends CrudPage
{
    use SoftDeletes, CrudTrait;

    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @var array
     */
    protected $fillable = [
        'template_id', 'title', 'slug', 'description', 'content', 'extras',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pageTemplate()
    {
        return $this->belongsTo(PageTemplate::class, 'template_id');
    }

    /**
     * Get page template list as array
     *
     * Используется в Админпанели в качестве значения поля типа model_function
     * см App\Http\Controllers\Web\Pages\PageCrudController
     *
     * @return array
     */
    public function adminGetPageTempletes()
    {
        return $this->pageTemplate()->select('id', 'title')->get()->keyBy('id')->toArray();
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

}
