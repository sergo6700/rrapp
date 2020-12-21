<?php

namespace Tests\Feature\Web\News;

use App\Models\Post\NewsItem;

/**
 * Class NewsDetailTest
 *
 * @coversDefaultClass \App\Http\Controllers\Web\News\NewsController
 * @package Tests\Feature\Web\News
 */
class NewsDetailTest extends AbstractNewsTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Web\News\NewsController::show
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $news = NewsItem::where($this->news_data)->first();
        $response = $this->get(route('news.show', ['slug' => $news->slug]));

        $response->assertStatus(200);
        $response->assertViewIs('web.news.show');
    }
}
