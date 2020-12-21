<?php

namespace Tests\Feature\Web\News;

use Tests\Feature\BaseFeatureTest;
use App\Models\Post\NewsItem;
use Carbon\Carbon;
use App\Support\Enum\Post\VisibilityType;

/**
 * Class AbstractNewsTest
 * @package Tests\Feature\Web\News
 */
abstract class AbstractNewsTest extends BaseFeatureTest
{
    /**
     * Example news data
     *
     * @var array $news_data
     */
    protected $news_data = [
        'title' => 'Заголовок новости',
        'content' => 'Содержимое новости',
    ];

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp() :void
    {
        parent::setUp();

        $visibilityTypes = VisibilityType::getValues();
        $visibilityTypes_keys = array_keys($visibilityTypes);

        $picture = $this->createPicture();

        $news_data = array_merge($this->news_data, [
            'date' => Carbon::now()->addDay()->format('Y-m-d'),
            'visibility_type_id' => $visibilityTypes_keys[array_rand($visibilityTypes_keys)],
            'picture_id' => $picture->id,
        ]);

        NewsItem::create($news_data);
    }
}
