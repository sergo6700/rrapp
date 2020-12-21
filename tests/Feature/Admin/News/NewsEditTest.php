<?php

namespace Tests\Feature\Admin\News;

use App\Models\Post\NewsItem;

/**
 * Class NewsEditTest
 * @package Tests\Feature\Admin\News
 */
class NewsEditTest extends AbstractNewsTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Post\NewsCrudController::edit
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $news = NewsItem::where($this->news_data)->first();
        $response = $this->get(route('crud.news.edit', ['slug' => $news->slug]));

        $response->assertOk();
        $response->assertViewIs("crud::edit");
    }
}
