<?php

namespace Tests\Feature\Web\Articles;

use App\Models\Post\Article;
use App\Support\Enum\Post\VisibilityType;

/**
 * Class LimitedArticleVisibilityTest
 *
 * @coversDefaultClass \App\Http\Controllers\Web\Articles\ArticleController
 *
 * @package Tests\Feature\Web\Articles
 */
class LimitedArticleVisibilityTest extends AbstractArticleTest
{
    /**
     * Set limited visibility for viewing an article
     *
     * @return void
     */
    private function setLimitedVisibility() :void
    {
        Article::where($this->article_data)
            ->update(['visibility_type_id' => VisibilityType::AUTH_ONLY]);
    }

    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Web\Articles\ArticleController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->setLimitedVisibility();
        $article = Article::where($this->article_data)->where('visibility_type_id', VisibilityType::AUTH_ONLY)->first();

        $response = $this->get(route('article.show', ['slug' => $article->slug]));

        $response->assertStatus(200);
        $response->assertViewIs('web.articles.show');
        $response->assertSee(config('handbook.closed_block_text'));
    }
}
