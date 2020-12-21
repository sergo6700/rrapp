<?php

namespace Tests\Feature\Web\Articles;

use Tests\Feature\BaseFeatureTest;

/**
 * Class ArtilceListTest
 *
 * @coversDefaultClass \App\Http\Controllers\Web\Articles\ArticleController
 * @package Tests\Feature\Web\Articles
 */
class ArtilceListTest extends BaseFeatureTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Web\Articles\ArticleController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $response = $this->get(route('article.index'));
        $response->assertStatus(200);
        $response->assertViewIs('web.articles.index');
    }
}
