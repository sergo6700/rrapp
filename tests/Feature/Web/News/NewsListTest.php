<?php

namespace Tests\Feature\Web\News;

/**
 * Class NewsListTest
 *
 * @coversDefaultClass \App\Http\Controllers\Web\News\NewsController
 * @package Tests\Feature\Web\News
 */
class NewsListTest extends AbstractNewsTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Web\News\NewsController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $response = $this->get(route('news'));
        $response->assertStatus(200);
        $response->assertViewIs('web.news.index');
    }
}
