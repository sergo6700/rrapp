<?php

namespace Tests\Feature\Admin\Articles;

use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class ArticleListTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Post\ArticleCrudController
 * @package Tests\Feature\Admin\Articles
 */
class ArticleListTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Post\ArticleCrudController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.article.index'));

        $response->assertOk();
        $response->assertViewIs("crud::list");
    }
}
