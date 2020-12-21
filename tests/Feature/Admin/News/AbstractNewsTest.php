<?php

namespace Tests\Feature\Admin\News;

use Tests\Feature\Admin\AdminLoginTest;
use App\Models\Post\NewsItem;
use Carbon\Carbon;
use App\Support\Enum\Post\VisibilityType;

/**
 * Class AbstractNewsTest
 * @package Tests\Feature\Admin\News
 */
abstract class AbstractNewsTest extends AdminLoginTest
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
