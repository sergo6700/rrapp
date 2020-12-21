<?php

namespace Tests\Feature\Web\Articles;

use App\Models\Post\Article;

/**
 * Class ArtilceDetailTest
 *
 * @coversDefaultClass \App\Http\Controllers\Web\Articles\ArticleController
 * @package Tests\Feature\Web\Articles
 */
class ArtilceDetailTest extends AbstractArticleTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Web\Articles\ArticleController::show
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $article = Article::where($this->article_data)->first();
        $response = $this->get(route('article.show', ['slug' => $article->slug]));

        $response->assertStatus(200);
        $response->assertViewIs('web.articles.show');
    }
}
