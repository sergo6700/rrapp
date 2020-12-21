<?php

namespace App\Models\PageMetadata;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PageMetadata
 *
 * @package App\Models\PageMetadata
 */
class PageMetadata extends Model
{
    use CrudTrait;

    /**
     * @var string
     */
    const MAIN_ALIAS = 'main';

    /**
     * @var string
     */
    const SERVICES_ALIAS = 'services';

    /**
     * @var string
     */
    const ARTICLES_ALIAS = 'articles';

    /**
     * @var string
     */
    const NEWS_ALIAS = 'news';

    /**
     * @var string
     */
    const DEPARTMENTS_ALIAS = 'departments';

    /**
     * @var string
     */
    const DOCS_ALIAS = 'docs';

    /**
     * @var string
     */
    const UPCOMING_EVENTS_ALIAS = 'upcoming-events';

    /**
     * @var string
     */
    const PAST_EVENTS_ALIAS = 'past-events';

    /**
     * @var string
     */
    const MEDIA_ALIAS = 'media';

    /**
     * @var string
     */
    const PROFILE_ALIAS = 'profile';

    /**
     * @var string
     */
    protected $table = 'page_metadatas';

    /**
     * @var array
     */
    protected $fillable = [
        'page_alias',
        'title',
        'description'
    ];
}
