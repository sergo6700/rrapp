<?php

namespace Tests\Feature\Admin\Articles;

use App\Models\Post\Article;

/**
 * Class ArticleEditTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Post\ArticleCrudController
 * @package Tests\Feature\Admin\Articles
 */
class ArticleEditTest extends AbstractArticleTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Post\ArticleCrudController::edit
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $article = Article::where($this->article_data)->first();
        $response = $this->get(route('crud.article.edit', ['slug' => $article->slug]));

        $response->assertOk();
        $response->assertViewIs("crud::edit");
    }
}
