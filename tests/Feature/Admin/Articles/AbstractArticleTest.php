<?php

namespace Tests\Feature\Admin\Articles;

use Carbon\Carbon;
use Tests\Feature\Admin\AdminLoginTest;
use App\Models\Post\Article;
use App\Support\Enum\Post\VisibilityType;

/**
 * Class AbstractArticleTest
 * @package Tests\Feature\Admin\Articles
 */
abstract class AbstractArticleTest extends AdminLoginTest
{
    /**
     * Example article data
     *
     * @var array $article_data
     */
    protected $article_data = [
        'title' => 'Заголовок статьи',
        'content' => 'Содержимое статьи',
    ];

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp() :void
    {
        parent::setUp();

        $article_view_types = config('handbook.article_view_type');
        $article_view_type = $article_view_types[array_rand($article_view_types)];

        $visibilityTypes = VisibilityType::getValues();
        $visibilityTypes_keys = array_keys($visibilityTypes);

        $picture = $this->createPicture();

        $article_data = array_merge($this->article_data, [
            'date' => Carbon::now()->addDay()->format('Y-m-d'),
            'view_id' => $article_view_type['id'],
            'visibility_type_id' => $visibilityTypes_keys[array_rand($visibilityTypes_keys)],
            'picture_id' => $picture->id,
        ]);

        Article::create($article_data);

        $this->assertDatabaseHas((new Article())->getTable(),
            $article_data
        );
    }
}
